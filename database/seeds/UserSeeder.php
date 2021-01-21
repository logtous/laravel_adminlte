<?php

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('model_has_permissions')->truncate();
        DB::table('model_has_roles')->truncate();
        DB::table('role_has_permissions')->truncate();
        DB::table('users')->truncate();
        DB::table('roles')->truncate();
        DB::table('permissions')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $user = User::query()->create([
            'name' => 'admin',
            'email' => 'laravel_adminlte@logtous.com',
            'password' => Hash::make('12345678')
        ]);

        $role = Role::create([
            'name' => 'Administrator',
        ]);

        $permissions = [
            [
                'name' => 'system',
                'route' => '',
                'icon' => 'fa-cog',
                'child' => [
                    [
                        'name' => 'system.user',
                        'route' => 'user.index',
                        'icon' => 'fa-th',
                        'child' => [
                            ['name' => 'system.user.index' ,'route'=>'user.index'],
                            ['name' => 'system.user.create' ,'route'=>'user.create'],
                            ['name' => 'system.user.edit' ,'route'=>'user.edit'],
                            ['name' => 'system.user.destroy' ,'route'=>'user.destroy'],
                            ['name' => 'system.user.role' ,'route'=>'user.role'],
                            ['name' => 'system.user.permission' ,'route'=>'user.permission'],
                        ]
                    ],
                    [
                        'name' => 'system.role',
                        'route' => 'role.index',
                        'icon' => 'fa-th',
                        'child' => [
                            ['name' => 'system.role.index' ,'route'=>'role.index'],
                            ['name' => 'system.role.create' ,'route'=>'role.create'],
                            ['name' => 'system.role.edit' ,'route'=>'role.edit'],
                            ['name' => 'system.role.destroy' ,'route'=>'role.destroy'],
                            ['name' => 'system.role.permission' ,'route'=>'role.permission'],
                        ]
                    ],
                    [
                        'name' => 'system.permission',
                        'route' => 'permission.index',
                        'icon' => 'fa-th',
                        'child' => [
                            ['name' => 'system.permission.index' ,'route'=>'permission.index'],
                            ['name' => 'system.permission.create', 'route'=>'permission.create'],
                            ['name' => 'system.permission.edit', 'route'=>'permission.edit'],
                            ['name' => 'system.permission.destroy', 'route'=>'permission.destroy'],
                        ]
                    ],
                ]
            ],
        ];

        foreach ($permissions as $permission) {
            $firstLevelPermission = Permission::create([
                'name' => $permission['name'],
                'route' => $permission['route']??'',
                'icon' => $permission['icon']??'fa-th',
            ]);
            $role->givePermissionTo($firstLevelPermission);
            $user->givePermissionTo($firstLevelPermission);
            if (isset($permission['child'])) {
                foreach ($permission['child'] as $permission_child) {
                    $secondLevelPermission = Permission::create([
                        'name' => $permission_child['name'],
                        'parent_id' => $firstLevelPermission->id,
                        'route' => $permission_child['route']??1,
                        'icon' => $permission_child['icon']??1,
                        'type' => isset($permission_child['type']) ? $permission_child['type'] : 2,
                    ]);
                    $role->givePermissionTo($secondLevelPermission);
                    $user->givePermissionTo($secondLevelPermission);
                    if (isset($permission_child['child'])) {
                        foreach ($permission_child['child'] as $permission_child_child) {
                            $thirdLevelPermission = Permission::create([
                                'name' => $permission_child_child['name'],
                                'parent_id' => $secondLevelPermission->id,
                                'route' => $permission_child_child['route']??'',
                                'icon' => $permission_child_child['icon']??'fa-th',
                                'type' => isset($permission_child['type']) ? $permission_child['type'] : 2,
                            ]);
                            $role->givePermissionTo($thirdLevelPermission);
                            $user->givePermissionTo($thirdLevelPermission);
                        }
                    }
                }
            }
        }

        $user->assignRole($role);
    }
}
