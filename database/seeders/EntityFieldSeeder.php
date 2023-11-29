<?php

namespace Database\Seeders;

use App\Models\Entity;
use App\Models\EntityField;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            if ($item['type'] === 'select' or $item['type'] === 'object') {
                $entityFieldId = $this->create($entity->id, $key, $item['type'], $item['hash'], $item['inStat'], 255);
                $fields[$item['hash']] = [
                    'relateTo' => null,
                    'type' => $item['type'],
                    'id' => $entityFieldId
                ];
                $this->call(
                    [
                        EntityFieldFixedValueSeeder::class,
                    ],
                    false,
                    [
                        'entityFieldId' => $entityFieldId,
                        'fieldNames' => $item['value']
                    ],
                );
            } else {
                $relateTo = null;
                if ($item['type'] === 'relation') {
                    $relateTo = $item['relateTo'];
                }
                $entityFieldId = $this->create($entity->id, $key, $item['type'], $item['hash'], $item['inStat'], 255, $relateTo);
                $fields[$item['hash']] = [
                    'relateTo' => $relateTo,
                    'type' => $item['type'],
                    'id' => $entityFieldId
                ];;
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

    private function create($entityId, $name, $type, $hash, $inStat, $maxLength, $relateTo = null): string
    {
        $entityField = EntityField::create([
            'entity_id' => $entityId,
            'name' => $name,
            'type' => $type,
            'hash' => $hash,
            'in_stat' => $inStat,
            'max_length' => $maxLength,
            'relate_to' => $relateTo
        ]);

        return $entityField->id;
    }
}
