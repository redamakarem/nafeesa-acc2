<?php

namespace Database\Seeders;

use App\Models\Labor;
use Illuminate\Database\Seeder;

class LaborsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $labors = [
          [
              'title_en' => 'Specialized',
              'title_ar' => 'عامل متخصص',
              'monthly_salary' => 550.000,
          ],
            [
                'title_en' => 'Assistant',
                'title_ar' => 'عامل مساعد',
                'monthly_salary' => 350.000,
            ],
            [
                'title_en' => 'Cleaner',
                'title_ar' => 'عامل تنظيف',
                'monthly_salary' => 250.000,
            ],
            [
                'title_en' => 'Other',
                'title_ar' => 'آخر',
                'monthly_salary' => 200.000,
            ]
        ];

        Labor::insert($labors);
    }
}
