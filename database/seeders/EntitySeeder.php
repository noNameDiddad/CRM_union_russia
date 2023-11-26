<?php

namespace Database\Seeders;

use App\Models\Entity;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EntitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run($entityName, $json): void
    {
        Entity::create([
            'name' => $entityName,
            'hash' => Str::slug($entityName),
        ]);

        $this->call(
            [
                EntityFieldSeeder::class,
            ],
            false,
            [
                'entityName' => $entityName,
                'json' => $json
            ]
        );
    }
}
