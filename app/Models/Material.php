<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;
    protected $table = 'materials';
    protected $fillable = ['amount'];

    public function materialable()
    {
        return $this->morphTo();
    }

    public function rawMaterials()
    {
        return $this->morphedByMany(RawMaterial::class,'materialable');
    }
    public function semiFinished()
    {
        return $this->morphedByMany(SemiFinished::class,'materialable');
    }
}
