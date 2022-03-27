<?php

namespace App\Models;

use \DateTimeInterface;
use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FixedAsset extends Model
{
    use HasFactory;
    use HasAdvancedFilter;
    use SoftDeletes;

    public $table = 'fixed_assets';

    public $orderable = [
        'id',
        'name',
        'hawally',
        'oquila',
        'salmiya',
        'jahra',
        'ardiya',
        'qurain',
    ];

    public $filterable = [
        'id',
        'name',
        'hawally',
        'oquila',
        'salmiya',
        'jahra',
        'ardiya',
        'qurain',
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
    ];

    public function branches()
    {
        return $this->belongsToMany(Branch::class)
            ->using(BranchFixedAsset::class)
            ->withPivot('amount');
    }

    public function getBranchesByIdAttribute()
    {
        return $this->branches->keyBy('id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
