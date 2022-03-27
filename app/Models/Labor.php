<?php

namespace App\Models;

use \DateTimeInterface;
use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Labor extends Model
{
    use HasFactory;
    use HasAdvancedFilter;
    use SoftDeletes;

    public $table = 'labors';

    public $orderable = [
        'id',
        'title_en',
        'title_ar',
        'basic_salary',
        'allowance',
        'indemnity_expenses',
        'leave_expenses',
        'flat_rent',
        'medical_insurance',
        'visa_residency',
        'workers_insurance',
        'uniform_expenses',
    ];

    public $filterable = [
        'id',
        'title_en',
        'title_ar',
        'basic_salary',
        'allowance',
        'indemnity_expenses',
        'leave_expenses',
        'flat_rent',
        'medical_insurance',
        'visa_residency',
        'workers_insurance',
        'uniform_expenses',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title_en',
        'title_ar',
        'basic_salary',
        'allowance',
        'indemnity_expenses',
        'leave_expenses',
        'flat_rent',
        'medical_insurance',
        'visa_residency',
        'workers_insurance',
        'uniform_expenses',
        'travel_expenses'
    ];

    public function getTotalSalaryAttribute()
    {
        return $this->basic_salary + $this->allowance;
    }

    public function getLaborCostAttribute()
    {
        return $this->cost_per_hour * $this->getTotalLaborTimeAttribute();
    }

    public function getTotalLaborTimeAttribute()
    {
        return $this->pivot->labor_time * $this->pivot->workers;
    }

    public function getTotalCostAttribute()
    {
        return $this->total_salary +
            $this->indemnity_expenses +
            $this->leave_expenses +
            $this->flat_rent +
            $this->medical_insurance +
            $this->visa_residency +
            $this->workers_insurance +
            $this->uniform_expenses +
            $this->travel_expenses;
    }

    public function getCostPerHourAttribute()
    {
        return $this->total_cost/208;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
