<?php

namespace Database\Seeders;

use App\Classes\Permissions;
use App\Models\User;
use App\Modules\Groups\Models\Group;
use App\Modules\Groups\Models\UserGroup;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'admin',
            'password' => Hash::make('1q2w3e4r'),
            'email' => 'admin@admin.com'
        ]);
        $modules = config('module.modules');

        if (in_array('Groups', $modules) and in_array('Users', $modules)) {
            $adminGroup = Group::create([
                'name' => 'admin'
            ]);

            foreach (['Groups', 'Users', 'Test'] as $module) {
                foreach (Permissions::getAll() as $permission) {
                    $adminGroup->permissions()->create([
                        'permission' => $permission,
                        'module' => $module,
                        'value' => true,
                    ]);
                }
            }
            UserGroup::create([
                'user_id' => $admin->id,
                'group_id' => $adminGroup->id
            ]);
        }
    }
}
