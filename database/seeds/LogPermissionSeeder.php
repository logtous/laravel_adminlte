<?php

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LogPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::query()->where([
            'name' => 'admin',
            'email' => 'laravel_adminlte@logtous.com'
        ])->first();

        if (!$user) {
            return;
        }

        $role = Role::query()->where([
            'name' => 'Administrator',
        ])->first();

        if (!$role) {
            return;
        }

        $permissions = [
            [
                'name' => 'system',
                'route' => '',
                'icon' => 'fa-cog',
                'child' => [
                    [
                        'name' => 'system.login_log',
                        'route' => 'login_log.index',
                        'icon' => 'fa-th',
                        'child' => [
                            ['name' => 'system.login_log.index' ,'route'=>'login_log.index'],
                            ['name' => 'system.login_log.destroy', 'route'=>'login_log.destroy'],
                        ]
                    ],
                    [
                        'name' => 'system.operate_log',
                        'route' => 'operate_log.index',
                        'icon' => 'fa-th',
                        'child' => [
                            ['name' => 'system.operate_log.index' ,'route'=>'operate_log.index'],
                            ['name' => 'system.operate_log.destroy', 'route'=>'operate_log.destroy'],
                        ]
                    ],
                ]
            ],
        ];

        foreach ($permissions as $permission) {
            $firstLevelPermission = Permission::where([
                'name' => $permission['name'],
                'route' => $permission['route']??'',
                'icon' => $permission['icon']??'fa-th',
            ])->first();
            if (!$firstLevelPermission) {
                $firstLevelPermission = Permission::create([
                    'name' => $permission['name'],
                    'route' => $permission['route']??'',
                    'icon' => $permission['icon']??'fa-th',
                ]);
                $role->givePermissionTo($firstLevelPermission);
                $user->givePermissionTo($firstLevelPermission);
            }
            if (isset($permission['child'])) {
                foreach ($permission['child'] as $permission_child) {
                    $secondLevelPermission = Permission::where([
                        'name' => $permission_child['name'],
                        'parent_id' => $firstLevelPermission->id,
                        'route' => $permission_child['route']??1,
                        'icon' => $permission_child['icon']??1,
                        'type' => isset($permission_child['type']) ? $permission_child['type'] : 2,
                    ])->first();
                    if (!$secondLevelPermission) {
                        $secondLevelPermission = Permission::create([
                            'name' => $permission_child['name'],
                            'parent_id' => $firstLevelPermission->id,
                            'route' => $permission_child['route']??1,
                            'icon' => $permission_child['icon']??1,
                            'type' => isset($permission_child['type']) ? $permission_child['type'] : 2,
                        ]);
                        $role->givePermissionTo($secondLevelPermission);
                        $user->givePermissionTo($secondLevelPermission);
                    }
                    if (isset($permission_child['child'])) {
                        foreach ($permission_child['child'] as $permission_child_child) {
                            $thirdLevelPermission = Permission::where([
                                'name' => $permission_child_child['name'],
                                'parent_id' => $secondLevelPermission->id,
                                'route' => $permission_child_child['route']??'',
                                'icon' => $permission_child_child['icon']??'fa-th',
                                'type' => isset($permission_child['type']) ? $permission_child['type'] : 2,
                            ])->first();
                            if (!$thirdLevelPermission) {
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
        }

        $user->assignRole($role);
    }
}
