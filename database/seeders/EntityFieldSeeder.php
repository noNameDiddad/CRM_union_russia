<?php

namespace Database\Seeders;

use App\Models\Entity;
use App\Models\EntityField;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
            $fixedValuesType = ['select', 'stage'];
            $item['hash'] = Str::slug($key);
            if (in_array($item['type'], $fixedValuesType)) {
                $entityFieldId = $this->create($entity->id, $key, $item['type'], $item['hash'], $item['inStat'], 255);
                $fields[$item['hash']] = [
                    'relateTo' => null,
                    'subType' => null,
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
            }elseif ($item['type'] === 'object') {
                $entityFieldId = $this->create($entity->id, $key, $item['type'], $item['hash'], $item['inStat'], 500, $item['subType']);
                $fields[$item['hash']] = [
                    'relateTo' => null,
                    'subType' => $item['subType'],
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
            }else {
                $relateTo = null;
                $subType = null;
                if ($item['type'] === 'relation') {
                    $relateTo = $item['relateTo'];
                }
                $entityFieldId = $this->create($entity->id, $key, $item['type'], $item['hash'], $item['inStat'], 255, $subType, $relateTo);
                $fields[$item['hash']] = [
                    'relateTo' => $relateTo,
                    'subType' => $subType,
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

    private function create($entityId, $name, $type, $hash, $inStat, $maxLength, $subtype = null, $relateTo = null, ): string
    {
        $entityField = EntityField::create([
            'entity_id' => $entityId,
            'name' => $name,
            'type' => $type,
            'hash' => $hash,
            'sub_type' => $subtype,
            'in_stat' => $inStat,
            'max_length' => $maxLength,
            'relate_to' => $relateTo
        ]);

        return $entityField->id;
    }
}
