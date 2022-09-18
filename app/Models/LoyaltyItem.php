<?php

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LoyaltyItem extends Model
{
    use HasFactory;
    use HasAdvancedFilter;

    protected $fillable =[
        'item_id'
    ];
    public $filterable =[
        'item_id',
        'item.name_en',
    ];

    public $orderable = [
        'item_id',
        'item.name_en',
    ];
    

    public function item()
    {
        return $this->belongsTo(Finished::class,'item_id');
    }
}
