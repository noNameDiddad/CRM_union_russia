<?php

namespace Database\Seeders;

use App\Data\EntityData;
use App\Models\Entity;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class EntitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run($entityName, $json, $hash): void
    {
        $entity = EntityData::from($json+['name' => $entityName, 'hash' => $hash]);
        $entity_id = Entity::create($entity->toArray())->id;

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
        $dirName = env('IMPORT_DIR');
        $filterPath = $dirName . '/filters/'.$hash.'.json';
        if (File::exists($filterPath)) {
            dump('Обработка файла ' . $filterPath . '.' );
            $entityFilter = File::json($filterPath);
            foreach ($entityFilter as $name => $value) {
                $entityName = $name;
                $this->call(
                    [
                        FieldFilterSeeder::class,
                    ],
                    false,
                    [
                        'entity_id' => $entity_id,
                        'filterName' => $name,
                        'json' => $value,
                    ]
                );
            }
        }
    }
}
