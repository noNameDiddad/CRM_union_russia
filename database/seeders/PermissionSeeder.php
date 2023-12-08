<?php

namespace Database\Seeders;

use App\Models\Entity;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run($roles, $json): void
    {
        foreach ($roles as $item) {
            foreach ($json['roles'][$item->name]['permissions'] as $key => $permission_item) {
                Permission::create([
                    'role_id' => $item->id,
                    'permissions' => $permission_item,
                    'hash' =>$key,
                ]);
            }
        }
    }
}
