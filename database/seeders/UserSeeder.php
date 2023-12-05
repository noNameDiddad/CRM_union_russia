<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run($roles): void
    {
        User::factory()->create([
            'role_id' => collect($roles)->where('hash', 'admin')->first()->id,
            'email' => 'example@example.com',
        ]);
        foreach ($roles as $item) {
            User::factory()->create(['role_id' => $item->id]);
        }
    }
}
