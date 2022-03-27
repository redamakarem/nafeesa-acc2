<?php

namespace App\Models;

use \DateTimeInterface;
use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RawMaterial extends Model
{
    use HasFactory;
    use HasAdvancedFilter;
    use SoftDeletes;

    public $table = 'raw_materials';

    public $orderable = [
        'id',
        'name_en',
        'name_ar',
        'code',
        'avg_cost',
        'unit.name_en',
        'updated_at',
    ];

    public $filterable = [
        'id',
        'name_en',
        'name_ar',
        'code',
        'avg_cost',
        'unit.name_en',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name_en',
        'name_ar',
        'code',
        'avg_cost',
        'unit_id',
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function semiFinished()
    {
        return $this->belongsToMany(SemiFinished::class);
    }
}
