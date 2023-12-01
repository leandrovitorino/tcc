<?php

namespace Database\Seeders;

use App\Role\Models\Permission;
use App\Role\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            [
                'id' => 1,
                'name' => 'Administrator'
            ],
            [
                'id' => 2,
                'name' => 'Student'
            ],
            [
                'id' => 3,
                'name' => 'Teacher'
            ]
        ];

        DB::table('roles')->insert($roles);

        $role = Role::find(1);
        $role->cleanPermissions();
        $permissions = Permission::all();
        foreach ($permissions as $permission){
            $role->allowTo($permission);
        }

        $users = [
            [
                'name' => 'Developers',
                'email' => 'dev@mail',
                'role_id' => 1,
                'password' => Hash::make(123456),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];

        DB::table('users')->insert($users);
    }
}
