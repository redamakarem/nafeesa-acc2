<?php

namespace App\Models;

use \DateTimeInterface;
use App\Support\HasAdvancedFilter;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sales extends Model
{
    use HasFactory;
    use HasAdvancedFilter;
    use SoftDeletes;

    public $table = 'sales';

    public $orderable = [
        'id',
        'item.name_en',
        'qty',
        'costs',
        'profit',
        'date',
        'branch.title_en',
    ];

    public $filterable = [
        'id',
        'item.name_en',
        'qty',
        'date',
        'branch.title_en',
    ];

    protected $fillable = [
        'item_id',
        'qty',
        'date',
        'branch_id',
        'selling_price',
        'weekday',
        'profit',
        'costs',
    ];

    protected $dates = [
        'date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function item()
    {
        return $this->belongsTo(Finished::class);
    }

    public function getDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('project.date_format')) : null;
    }

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = $value ? Carbon::createFromFormat(config('project.date_format'), $value)->format('Y-m-d') : null;
    }

//    public function setProfitAttribute($value)
//    {
//        $this->attributes['profit'] = $this->getProfitAttribute();
//    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }


//    public function getTotalCostsAttribute()
//    {
//        return $this->item->cost_per_unit * $this->qty;
//    }
    public function getTotalSalesAttribute()
    {
        return $this->item->sale_price * $this->qty;
    }
//    public function getProfitAttribute()
//    {
//        return $this->total_sales - $this->costs;
//    }

    protected static function boot()
    {
        parent::boot();
        static::created(function (Sales $sale) {

//            dd($sale->total_sales);
            $sale->costs = $sale->item->cost_per_unit * $sale->qty;
            $sale->profit = $sale->selling_price - $sale->costs;
            $sale->weekday = Carbon::parse($sale->date)->dayOfWeek;
            $sale->save();
        });
    }


}
