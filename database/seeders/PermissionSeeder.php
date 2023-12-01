<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'name' => 'Role Management'
            ],
            [
                'name' => 'User Management'
            ],
            [
                'name' => 'LOG'
            ],
            [
                'name' => 'Question Management'
            ],
            [
                'name' => 'Team'
            ]
        ];

        DB::table('permissions')->insert($permissions);
    }
}
