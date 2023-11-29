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
    public function run($entityName, $json, $hash): void
    {
        Entity::create([
            'name' => $entityName,
            'hash' => $hash,
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
