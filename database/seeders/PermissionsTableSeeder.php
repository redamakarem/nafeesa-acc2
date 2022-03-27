<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'auth_profile_edit',
            ],
            [
                'id'    => 2,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 3,
                'title' => 'permission_create',
            ],
            [
                'id'    => 4,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 5,
                'title' => 'permission_show',
            ],
            [
                'id'    => 6,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 7,
                'title' => 'permission_access',
            ],
            [
                'id'    => 8,
                'title' => 'role_create',
            ],
            [
                'id'    => 9,
                'title' => 'role_edit',
            ],
            [
                'id'    => 10,
                'title' => 'role_show',
            ],
            [
                'id'    => 11,
                'title' => 'role_delete',
            ],
            [
                'id'    => 12,
                'title' => 'role_access',
            ],
            [
                'id'    => 13,
                'title' => 'user_create',
            ],
            [
                'id'    => 14,
                'title' => 'user_edit',
            ],
            [
                'id'    => 15,
                'title' => 'user_show',
            ],
            [
                'id'    => 16,
                'title' => 'user_delete',
            ],
            [
                'id'    => 17,
                'title' => 'user_access',
            ],
            [
                'id'    => 18,
                'title' => 'raw_material_create',
            ],
            [
                'id'    => 19,
                'title' => 'raw_material_edit',
            ],
            [
                'id'    => 20,
                'title' => 'raw_material_show',
            ],
            [
                'id'    => 21,
                'title' => 'raw_material_delete',
            ],
            [
                'id'    => 22,
                'title' => 'raw_material_access',
            ],
            [
                'id'    => 23,
                'title' => 'unit_create',
            ],
            [
                'id'    => 24,
                'title' => 'unit_edit',
            ],
            [
                'id'    => 25,
                'title' => 'unit_show',
            ],
            [
                'id'    => 26,
                'title' => 'unit_delete',
            ],
            [
                'id'    => 27,
                'title' => 'unit_access',
            ],
            [
                'id'    => 28,
                'title' => 'semi_finished_create',
            ],
            [
                'id'    => 29,
                'title' => 'semi_finished_edit',
            ],
            [
                'id'    => 30,
                'title' => 'semi_finished_show',
            ],
            [
                'id'    => 31,
                'title' => 'semi_finished_delete',
            ],
            [
                'id'    => 32,
                'title' => 'semi_finished_access',
            ],
            [
                'id'    => 33,
                'title' => 'labor_create',
            ],
            [
                'id'    => 34,
                'title' => 'labor_edit',
            ],
            [
                'id'    => 35,
                'title' => 'labor_show',
            ],
            [
                'id'    => 36,
                'title' => 'labor_delete',
            ],
            [
                'id'    => 37,
                'title' => 'labor_access',
            ],
            [
                'id'    => 38,
                'title' => 'finished_create',
            ],
            [
                'id'    => 39,
                'title' => 'finished_edit',
            ],
            [
                'id'    => 40,
                'title' => 'finished_show',
            ],
            [
                'id'    => 41,
                'title' => 'finished_delete',
            ],
            [
                'id'    => 42,
                'title' => 'finished_access',
            ],
            [
                'id'    => 43,
                'title' => 'fixed_asset_create',
            ],
            [
                'id'    => 44,
                'title' => 'fixed_asset_edit',
            ],
            [
                'id'    => 45,
                'title' => 'fixed_asset_show',
            ],
            [
                'id'    => 46,
                'title' => 'fixed_asset_delete',
            ],
            [
                'id'    => 47,
                'title' => 'fixed_asset_access',
            ],
            [
                'id'    => 48,
                'title' => 'setting_create',
            ],
            [
                'id'    => 49,
                'title' => 'setting_edit',
            ],
            [
                'id'    => 50,
                'title' => 'setting_show',
            ],
            [
                'id'    => 51,
                'title' => 'setting_delete',
            ],
            [
                'id'    => 52,
                'title' => 'setting_access',
            ],
            [
                'id'    => 53,
                'title' => 'branch_create',
            ],
            [
                'id'    => 54,
                'title' => 'branch_edit',
            ],
            [
                'id'    => 55,
                'title' => 'branch_show',
            ],
            [
                'id'    => 56,
                'title' => 'branch_delete',
            ],
            [
                'id'    => 57,
                'title' => 'branch_access',
            ],
            [
                'id'    => 58,
                'title' => 'sale_create',
            ],
            [
                'id'    => 59,
                'title' => 'sale_edit',
            ],
            [
                'id'    => 60,
                'title' => 'sale_show',
            ],
            [
                'id'    => 61,
                'title' => 'sale_delete',
            ],
            [
                'id'    => 62,
                'title' => 'sale_access',
            ],


        ];

        Permission::insert($permissions);
    }
}
