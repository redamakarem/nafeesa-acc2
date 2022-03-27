<?php

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;


class Branch extends Model
{
    use HasFactory;
    use HasAdvancedFilter;
    use SoftDeletes;

    public $table = 'branches';

    public $orderable = [
        'id',
        'title_en',
        'title_ar',
        'shifts',
        'labor_count',
        'total_manhours',

    ];

    public $filterable = [
        'id',
        'title_en',
        'title_ar',
        'shifts',
        'labor_count',
        'total_manhours',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'title_en',
        'title_ar',
        'shifts',
        'labor_count',
        'total_manhours',
    ];

    public function fixedAssets()
    {
        return $this->belongsToMany(FixedAsset::class)
            ->withPivot('amount');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
