<?php

namespace App\Models;

use Carbon\Carbon;
use \DateTimeInterface;
use App\Models\TransactionType;
use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function type()
    {
        return $this->belongsTo(TransactionType::class,'transaction_type');
    }

    public function getDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('project.date_format')) : null;
    }

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = $value ? Carbon::createFromFormat(config('project.date_format'), $value)->format('Y-m-d') : null;
    }


    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }



    public function getTotalSalesAttribute()
    {
        return $this->item->sale_price * $this->qty;
    }

    protected static function boot()
    {
        parent::boot();
        static::created(function (Sales $sale) {
            $sale->costs = $sale->item->cost_per_unit * $sale->qty;
            $sale->profit = $sale->selling_price - $sale->costs;
            $sale->weekday = Carbon::parse($sale->date)->dayOfWeek;
            $sale->save();
        });
    }

    public function scopeIsSales(Builder $query)
    {
        return $query->where('transaction_type','=',1);
    }
    
    public function scopeIsNotSales(Builder $query)
    {
        return $query->where('transaction_type','!=',1);
    }
    public function scopeIsZeroCost(Builder $query)
    {
        return $query->where('costs','<=',0);
    }
    public function scopeIsZeroSalePrice(Builder $query)
    {
        return $query->where('selling_price','<=',0);
    }


}
