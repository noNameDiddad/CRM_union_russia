<?php

namespace Database\Seeders;

use App\Models\Entity;
use App\Models\EntityField;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EntityFieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run($entityName): void
    {
        $names = [
            "honorific",
            "name",
            "surname",
            "patronymic"
        ];

        $id = Entity::where('name', $entityName)->first()->id;

        foreach ($names as $name) {
            EntityField::create([
                'entity_id' => $id,
                'name' => $name,
                'type' => 'string',
                'max_length' => '255',
            ]);
        }

        EntityField::create([
            'entity_id' => $id,
            'name' => "phones",
            'type' => 'json',
            'max_length' => '255',
        ]);
    }
}
