<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transaction_types')->insert(
            [
                [
                    'name_en' => 'Sales',
                    'name_ar' => 'مبيعات',
                ],
                [
                    'name_en' => 'Spoilage',
                    'name_ar' => 'متلف',
                ],
                [
                    'name_en' => 'Employees Food',
                    'name_ar' => 'أكل موظفين',
                ],
                [
                    'name_en' => 'Hospitality',
                    'name_ar' => 'ضيافة',
                ],
                [
                    'name_en' => 'Marketing',
                    'name_ar' => 'تسويق',
                ],
            ]
        );
    }
}
