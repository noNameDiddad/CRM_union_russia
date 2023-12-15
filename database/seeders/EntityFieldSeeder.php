<?php

namespace Database\Seeders;

use App\Data\EntityFieldData;
use App\Models\Entity;
use App\Models\EntityField;
use Illuminate\Database\Seeder;

class EntityFieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run($entityName, $json): void
    {
        $entity = Entity::where('name', $entityName)->first();
        dump("Засеивание");
        dump($entityName);
        dump("----------");
        $fields = [];
        foreach ($json as $key => $item) {
            $fixedValuesType = ['select', 'stage', 'object'];
            $entityField = EntityFieldData::from($item + ['name' => $key, 'entity_id' => $entity->id]);
            $entityField = $this->create($entityField);
            $fields[$entityField->hash] = $entityField;
            if (in_array($entityField->type, $fixedValuesType)) {
                $this->call(
                    [
                        EntityFieldFixedValueSeeder::class,
                    ],
                    false,
                    [
                        'entityFieldId' => $entityField->id,
                        'fieldNames' => $item['value']
                    ],
                );
            }
        }
        $this->call(
            [
                EntityValueSeeder::class,
            ],
            false,
            [
                'entity' => $entity,
                'fields' => $fields
            ]
        );
    }

    private function create($entityField): EntityFieldData
    {
        $entityField = EntityField::create($entityField->toArray());

        return EntityFieldData::from($entityField->toArray());
    }
}
