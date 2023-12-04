<?php

namespace Database\Seeders;

use App\Models\Entity;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run($json): void
    {
        $roles = [];
        foreach ($json['roles'] as $key => $item) {
            $roles[] = Role::create([
                'name' => $key,
                'hash' => $item['hash'],
            ]);
        }
        $this->call(
            [
                UserSeeder::class,
            ],
            false,
            [
                'roles' => $roles
            ],
        );
    }
}
