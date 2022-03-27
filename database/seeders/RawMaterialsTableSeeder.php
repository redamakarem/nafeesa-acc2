<?php

namespace Database\Seeders;

use App\Models\RawMaterial;
use Illuminate\Database\Seeder;

class RawMaterialsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rawMaterials = [
          [
              'name_en' => 'IRANIAN PISTACHIO',
              'name_ar' => 'فستق ايراني',
              'code' => 10001,
              'avg_cost' => 5.500,
              'unit_id' => 1,
          ],
            [
                'name_en' => 'KABUL PISTACHIO',
                'name_ar' => 'فستق كابولي',
                'code' => 10002,
                'avg_cost' => 7.550,
                'unit_id' => 1,
            ],
            [
                'name_en' => 'ENTEBE PISTACHIO',
                'name_ar' => 'فستق عنتابي',
                'code' => 10003,
                'avg_cost' => 6.500,
                'unit_id' => 1,
            ],
            [
                'name_en' => 'HALVED ALMONDS',
                'name_ar' => 'لوز انصاف',
                'code' => 10004,
                'avg_cost' => 3.008,
                'unit_id' => 1,
            ],
            [
                'name_en' => 'QUARTERED ALMONDS',
                'name_ar' => 'لوز ارباع',
                'code' => 10005,
                'avg_cost' => 3.008,
                'unit_id' => 1,
            ]
        ];
        RawMaterial::insert($rawMaterials);
    }
}
