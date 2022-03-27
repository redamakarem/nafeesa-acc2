<?php

namespace App\Imports;

use App\Models\RawMaterial;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class RawMaterialImport implements ToCollection
{
    /**
    * @param Collection $rows
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            RawMaterial::create(
                [
                    'name_en' =>$row[1],
                    'name_ar' =>$row[2],
                    'avg_cost' =>$row[4],
                    'unit_id' =>$row[3],
                    'code' =>$row[0],
                ]
            );
        }
    }


}
