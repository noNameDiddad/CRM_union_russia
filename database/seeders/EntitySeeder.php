<?php

namespace Database\Seeders;

use App\Data\EntityData;
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
        $entity = EntityData::from($json+['name' => $entityName, 'hash' => $hash]);
        Entity::create($entity->toArray());

        $this->call(
            [
                EntityFieldSeeder::class,
            ],
            false,
            [
                'entityName' => $entityName,
                'json' => $json['fields'],
            ]
        );
    }
}
