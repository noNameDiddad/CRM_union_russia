<?php

namespace Database\Seeders;

use App\Models\Entity;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run($roles): void
    {
        foreach ($roles as $item) {
            User::factory()->create(['role_id' => $item->id]);
        }
    }
}
