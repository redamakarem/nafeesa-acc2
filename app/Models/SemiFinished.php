<?php

namespace App\Models;

use \DateTimeInterface;
use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SemiFinished extends Model
{
    use HasFactory;
    use HasAdvancedFilter;
    use SoftDeletes;

    public $table = 'semi_finisheds';

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
        'raw_materials.name_en',
        'kilos_per_dough',
        'item_code'

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
        'unit_id',
        'transport',
        'other',
        'notes',

    ];

    public function getTotalRawMaterialsCostAttribute()
    {
        return $this->calculate_total_cost();
    }

    public function getInputsPerKgAttribute()
    {
        return $this->rawMaterials->sum('pivot.amount')+$this->semiFinished->sum('pivot.amount');
    }

    public function getOutputsPerKgAttribute()
    {
        return $this->kilos_per_dough;
    }

    public function getProductionLossPercentageAttribute()
    {
        return (1 - ($this->getOutputsPerKgAttribute()/$this->getInputsPerKgAttribute())) * 100 ;
    }

    public function getCostPerKgAttribute()
    {
        return $this->getTotalRawMaterialsCostAttribute()/$this->kilos_per_dough;
    }

    public function getSalariesTotalAttribute()
    {
        return $this->calculate_total_salaries();
    }
    public function getFactorySalariesCostAttribute()
    {
        return ($this->getSalariesTotalAttribute()/(26*8)) * $this->total_labor_time;
    }
    public function getProductionPerHourAttribute()
    {
        return $this->kilos_per_dough / $this->total_labor_time;
    }

    public function getSharedCostsAttribute()
    {

        return $this->getAmohAttribute() * $this->getTotalLaborHoursAttribute();



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

    public function getFactoryTotalCostsAttribute()
    {
        return $this->getSharedCostsAttribute() + $this->getFactorySalariesCostAttribute();
    }

    public function getFactoryUnitCostsAttribute()
    {
        return $this->getFactoryTotalCostsAttribute()/$this->kilos_per_dough;
    }

    public function getLaborCostsAttribute()
    {
        return $this->calculate_labor_cost();
    }

    public function getNewTotalCostAttribute()
    {
        // $total = $this->getTotalRawMaterialsCostAttribute() +
        //     $this->getLaborCostsAttribute() +
        //     $this->getSharedCostsAttribute() +
        //     $this->getSemiFinishedTotalCostAttribute();
        // $result = $total / $this->kilos_per_dough;
        // return number_format($result,3);

        return number_format(($this->getFinalsTotalAttribute() / $this->kilos_per_dough),3) ;
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
            $item_total = $labor->total_cost * $labor->pivot->workers;
            $cost_total +=$item_total;
            $item_total =0;
        }
        return $cost_total;
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


    private function calculate_semiFinished_costs()
    {
        return $this->semiFinished->sum('new_total_cost');
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

    public function getQuantityCostAttribute()
    {
        return $this->pivot->amount * $this->new_total_cost;
    }


//    public function getTotalLaborTimeAttribute()
//    {
//        return $this->labor->sum('total_labor_time');
//    }

    public function getTotalLaborTimeAttribute()
    {
        $result = 0.0;
        $row_total = 0.0;
        foreach ($this->labor as $labor)
        {
            $row_total = $labor->pivot->workers * $labor->pivot->labor_time;
            $result += $row_total;
            $row_total = 0.0;
        }
        return $result;
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function rawMaterials()
    {
        return $this->belongsToMany(RawMaterial::class)
            ->withPivot('amount');
    }
    public function labor()
    {
        return $this->belongsToMany(Labor::class)
            ->withPivot(['workers','labor_time']);
    }

    public function semiFinished()
    {
        return $this->belongsToMany(SemiFinished::class,'semi_finished_ingredients','semi_finished_id','ingredient_id')
            ->withPivot('amount');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getAmohAttribute()
    {
        return 2.623;
    }

    public function getFinalsTotalAttribute()
    {
        $sum =
            $this->getTotalRawMaterialsCostAttribute() +
            $this->getLaborCostsAttribute() +
            $this->getSharedCostsAttribute() +
            $this->getSemiFinishedQuantityTotalAttribute();
        return $sum;

    }

    public function getTotalRelatedCosts()
    {
        return
        $this->transport+
        $this->other;
    }
}
