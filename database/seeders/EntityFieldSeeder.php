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
                if($item['type'] === 'array') {
                    $id = $this->create($entityId, $key, 'array', $item['typeOf'], 255);
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
                    $this->create($entityId, $key, $item['type'], $item['typeOf'], 255);
                }
            }
        }
    }

    private function create($entityId, $name, $type, $typeOf, $maxLength): string {
        $entityField  = EntityField::create([
            'entity_id' => $entityId,
            'name' => $name,
            'type' => $type,
            'type_of' => $typeOf,
            'max_length' => $maxLength
        ]);

        return $entityField->id;
    }
}
