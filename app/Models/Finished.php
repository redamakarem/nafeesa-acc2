<?php

namespace App\Models;

use \DateTimeInterface;
use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Finished extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;
    use HasAdvancedFilter;
    use SoftDeletes;


    public $table = 'finisheds';

    public $orderable = [
        'id',
        'name_en',
        'name_ar',
        'kilos_per_dough',
        'item_code'
    ];

    public $filterable = [
        'id',
        'name_en',
        'name_ar',
        'kilos_per_dough',
        'item_code',
        'raw_materials.name_en',
        'semi_finished.name_en',
        'labor.title_en',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'item_code',
        'name_en',
        'name_ar',
        'kilos_per_dough',
        'item_code',
        'freight',
        'transport',
        'loyalty',
        'other',
        'notes',
        'sale_price'
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }


    public function getTotalCostAttribute()
    {
        return $this->calculate_total_cost();
    }

    public function getInputsPerKgAttribute()
    {

        return $this->rawMaterials->sum('pivot.amount') + $this->semiFinished->sum('pivot.amount');
    }

    public function getOutputsPerKgAttribute()
    {
        return $this->kilos_per_dough;
    }

    public function getProductionLossPercentageAttribute()
    {

        if ($this->getInputsPerKgAttribute() >0) {
            return 1 - ($this->getOutputsPerKgAttribute() / $this->getInputsPerKgAttribute());
        }
        else{
            return 1;
        }
    }

    public function getCostPerKgAttribute()
    {
        return $this->getTotalCostAttribute()/$this->kilos_per_dough;
    }

    public function getSalariesTotalAttribute()
    {
        return $this->calculate_total_salaries();
    }
    public function getFactorySalariesCostAttribute()
    {
        return ($this->getSalariesTotalAttribute()/(26*8)) * $this->getTotalLaborHoursAttribute();
    }
    public function getProductionPerHourAttribute()
    {
        if ($this->getTotalLaborHoursAttribute() ==0)
            return 0;
        return $this->kilos_per_dough/$this->getTotalLaborHoursAttribute();
    }

    private function calculate_semiFinished_costs()
    {
        return $this->semiFinished->sum('new_total_cost');
    }
    public function getSemiFinishedTotalCostAttribute()
    {
        return $this->calculate_semiFinished_costs();
    }

    private function calculate_total_cost(){

        $cost_total = 0.0;
        foreach ($this->rawMaterials as $rawMaterial)
        {
            $item_total = $rawMaterial->avg_cost * $rawMaterial->pivot->amount;
            $cost_total +=$item_total;
            $item_total =0;
        }
        return $cost_total;
    }
    private function calculate_total_salaries(){

        $cost_total = 0.0;
        foreach ($this->labor as $labor)
        {
            $item_total = $labor->monthly_salary * $labor->pivot->workers;
            $cost_total +=$item_total;
            $item_total =0;
        }
        return $cost_total;
    }

    public function getSharedCostsAttribute()
    {

        return $this->getAmohAttribute() * $this->getTotalLaborHoursAttribute();

    }


    public function getTotalRawMaterialsCostAttribute()
    {
        return $this->calculate_total_cost();
    }

    private function calculate_labor_cost()
    {
        $hourly_labor_cost = 0;
        foreach ($this->labor as $labor)
        {
            $item_total = $labor->pivot->labor_time * $labor->cost_per_hour * $labor->pivot->workers;
            $hourly_labor_cost +=$item_total;
            $item_total =0;
        }
        return $hourly_labor_cost;
    }


    private function calculate_semiFinished_quantity_total()
    {
        $result = 0.0;
        foreach ($this->semiFinished as $semi)
        {
            $row_total = $semi->pivot->amount * $semi->new_total_cost;
            $result += $row_total;
            $row_total = 0.0;
        }
        return $result;
    }

    public function getSemiFinishedQuantityTotalAttribute()
    {
        return $this->calculate_semiFinished_quantity_total();
//        return $this->sum('quantity_cost');
    }



    public function getLaborCostsAttribute()
    {
        return $this->calculate_labor_cost();
    }


    public function getTotalLaborHoursAttribute()
    {
        $total_hours = 0.0;
        $total_labor = 0.0;
        foreach ($this->labor as $labor)
        {
            $workers = $labor->pivot->workers;
            $labor_time = $labor->pivot->labor_time;
            $total_labor = $workers * $labor_time;
            $total_hours += $total_labor;
            $total_labor = 0.0;
        }

        return $total_hours;
    }

    protected function getAmohAttribute()
    {
        return 2.623;
    }

    public function getFinalsTotalAttribute()
    {
        return $this->getTotalRawMaterialsCostAttribute() +
            $this->getLaborCostsAttribute() +
            $this->getSharedCostsAttribute() +
//            $this->getSemiFinishedTotalCostAttribute()+
            $this->getSemiFinishedQuantityTotalAttribute()+
            $this->getTotalRelatedCostsAttribute();
    }


    public function getCostPerUnitAttribute()
    {
        return $this->getFinalsTotalAttribute()/$this->getOutputsPerKgAttribute();
    }


    public function getTotalRelatedCostsAttribute()
    {
        return
            $this->transport+
            $this->other+
            $this->freight+
            $this->loyalty;
    }



    public function rawMaterials()
    {
        return $this->belongsToMany(RawMaterial::class)
            ->withPivot('amount');
    }

    public function semiFinished()
    {
        return $this->belongsToMany(SemiFinished::class)
            ->withPivot('amount');
    }

    public function labor()
    {
        return $this->belongsToMany(Labor::class)
            ->withPivot(['workers','labor_time']);


    }

    public function item_sales()
    {
        return $this->hasMany(Sales::class,'item_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function pps_count($start_date,$end_date,$branches)
    {
        $query=null;
        if($branches ==[]){
            $query = Sales::isSales()->whereBetween('date',[$start_date,$end_date])->where('item_id',$this->id)->sum('qty');
        }else{
            $query = Sales::isSales()->whereBetween('date',[$start_date,$end_date])->where('item_id',$this->id)->whereIn('branch_id',$branches)->sum('qty');
        }
        return $query;
    }
    public function pps_sales($start_date,$end_date)
    {
        $result = Sales::isSales()->whereBetween('date',[$start_date,$end_date])->where('item_id',$this->id)->sum('selling_price');
        return $result;
    }
}
