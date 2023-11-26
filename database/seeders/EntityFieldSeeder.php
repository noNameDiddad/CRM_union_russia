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
        $entityId = Entity::where('name', $entityName)->first()->id;
        dump("Засеивание");
        dump($entityName);
        dump("----------");
        foreach($json as $name => $value) {
            foreach ($value as $key => $item) {
                if($item['type'] === 'select' or $item['type'] === 'object') {
                    $id = $this->create($entityId, $key, 'select', $item['hash'], $item['in_stat'], 255);
                    $this->call(
                        [
                            EntityFieldFixedValueSeeder::class,
                        ],
                        false,
                        [
                            'entityFieldId' => $id,
                            'fieldNames' => $item
                        ],
                    );
                } else {
                    $this->create($entityId, $key, $item['type'], $item['hash'], $item['in_stat'], 255);
                }
            }
        }
    }

    private function create($entityId, $name, $type, $hash, $inStat, $maxLength): string {
        $entityField  = EntityField::create([
            'entity_id' => $entityId,
            'name' => $name,
            'type' => $type,
            'hash' => $hash,
            'in_stat' => $inStat,
            'max_length' => $maxLength
        ]);

        return $entityField->id;
    }
}
