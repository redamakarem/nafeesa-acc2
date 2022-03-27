<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;

class UnitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $units =[
            [
                'name_en' => 'KG',
                'name_ar' => 'KG',
            ],
            [
                'name_en' => 'LTR',
                'name_ar' => 'LTR',
            ],
            [
                'name_en' => 'PCS',
                'name_ar' => 'PCS',
            ],
            [
                'name_en' => 'PES',
                'name_ar' => 'PES',
            ],
            [
                'name_en' => 'ROLL',
                'name_ar' => 'ROLL',
            ],
            [
                'name_en' => 'PKT',
                'name_ar' => 'PKT',
            ]
        ];

        Unit::insert($units);
    }
}
