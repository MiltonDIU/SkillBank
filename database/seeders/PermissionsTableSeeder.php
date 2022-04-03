<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
//            [
//                'id'    => 1,
//                'title' => 'user_management_access',
//            ],
//            [
//                'id'    => 2,
//                'title' => 'permission_create',
//            ],
//            [
//                'id'    => 3,
//                'title' => 'permission_edit',
//            ],
//            [
//                'id'    => 4,
//                'title' => 'permission_show',
//            ],
//            [
//                'id'    => 5,
//                'title' => 'permission_delete',
//            ],
//            [
//                'id'    => 6,
//                'title' => 'permission_access',
//            ],
//            [
//                'id'    => 7,
//                'title' => 'role_create',
//            ],
//            [
//                'id'    => 8,
//                'title' => 'role_edit',
//            ],
//            [
//                'id'    => 9,
//                'title' => 'role_show',
//            ],
//            [
//                'id'    => 10,
//                'title' => 'role_delete',
//            ],
//            [
//                'id'    => 11,
//                'title' => 'role_access',
//            ],
//            [
//                'id'    => 12,
//                'title' => 'user_create',
//            ],
//            [
//                'id'    => 13,
//                'title' => 'user_edit',
//            ],
//            [
//                'id'    => 14,
//                'title' => 'user_show',
//            ],
//            [
//                'id'    => 15,
//                'title' => 'user_delete',
//            ],
//            [
//                'id'    => 16,
//                'title' => 'user_access',
//            ],
//            [
//                'id'    => 17,
//                'title' => 'profile_password_edit',
//            ],
//            [
//                'id'    => 18,
//                'title' => 'audit_log_show',
//            ],
//            [
//                'id'    => 19,
//                'title' => 'audit_log_access',
//            ],
//
//            [
//                'id'    => 20,
//                'title' => 'country_create',
//            ],
//            [
//                'id'    => 21,
//                'title' => 'country_edit',
//            ],
//            [
//                'id'    => 22,
//                'title' => 'country_show',
//            ],
//            [
//                'id'    => 23,
//                'title' => 'country_delete',
//            ],
//            [
//                'id'    => 24,
//                'title' => 'country_access',
//            ],
//            [
//                'id'    => 25,
//                'title' => 'profile_edit',
//            ],
//            [
//                'id'    => 26,
//                'title' => 'profile_show',
//            ],
//            [
//                'id'    => 27,
//                'title' => 'profile_access',
//            ],
//            [
//                'id'    => 28,
//                'title' => 'setting_edit',
//            ],
//            [
//                'id'    => 29,
//                'title' => 'setting_access',
//            ],
//
//            [
//                'id'    => 30,
//                'title' => 'slider_create',
//            ],
//            [
//                'id'    => 31,
//                'title' => 'slider_edit',
//            ],
//            [
//                'id'    => 32,
//                'title' => 'slider_show',
//            ],
//            [
//                'id'    => 33,
//                'title' => 'slider_delete',
//            ],
//            [
//                'id'    => 34,
//                'title' => 'slider_access',
//            ],

//            [
//                'id'    => 35,
//                'title' => 'position_create',
//            ],
//            [
//                'id'    => 36,
//                'title' => 'position_edit',
//            ],
//            [
//                'id'    => 37,
//                'title' => 'position_show',
//            ],
//            [
//                'id'    => 38,
//                'title' => 'position_delete',
//            ],
//            [
//                'id'    => 39,
//                'title' => 'position_access',
//            ],
//            [
//                'id'    => 40,
//                'title' => 'menu_create',
//            ],
//            [
//                'id'    => 42,
//                'title' => 'menu_edit',
//            ],
//            [
//                'id'    => 43,
//                'title' => 'menu_show',
//            ],
//            [
//                'id'    => 44,
//                'title' => 'menu_delete',
//            ],
//            [
//                'id'    => 45,
//                'title' => 'menu_access',
//            ],
//            [
//                'id'    => 46,
//                'title' => 'menu_management_access',
//            ],
//            [
//                'id'    => 47,
//                'title' => 'article_management_access',
//            ],
//            [
//                'id'    => 48,
//                'title' => 'article_category_create',
//            ],
//            [
//                'id'    => 49,
//                'title' => 'article_category_edit',
//            ],
//            [
//                'id'    => 50,
//                'title' => 'article_category_show',
//            ],
//            [
//                'id'    => 51,
//                'title' => 'article_category_delete',
//            ],
//            [
//                'id'    => 52,
//                'title' => 'article_category_access',
//            ],
//            [
//                'id'    => 53,
//                'title' => 'article_create',
//            ],
//            [
//                'id'    => 54,
//                'title' => 'article_edit',
//            ],
//            [
//                'id'    => 55,
//                'title' => 'article_show',
//            ],
//            [
//                'id'    => 56,
//                'title' => 'article_delete',
//            ],
//            [
//                'id'    => 57,
//                'title' => 'article_access',
//            ],
            [
                'id'    => 58,
                'title' => 'partner_create',
            ],
            [
                'id'    => 59,
                'title' => 'partner_edit',
            ],
            [
                'id'    => 60,
                'title' => 'partner_show',
            ],
            [
                'id'    => 61,
                'title' => 'partner_delete',
            ],
            [
                'id'    => 62,
                'title' => 'partner_access',
            ],
            [
                'id'    => 63,
                'title' => 'social_create',
            ],
            [
                'id'    => 64,
                'title' => 'social_edit',
            ],
            [
                'id'    => 65,
                'title' => 'social_show',
            ],
            [
                'id'    => 66,
                'title' => 'social_delete',
            ],
            [
                'id'    => 67,
                'title' => 'social_access',
            ],
        ];

        Permission::insert($permissions);
    }
}
