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

        foreach($json as $name => $value) {
            foreach ($value as $key => $item) {
                //$id = EntityField::max('id') + 1;
                if(is_array($item)) {
                    $id = $this->create($entityId, $key, 'array', 255);
                    dump("Это массив");
                    //dump($item);
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
                    $this->create($entityId, $key, $item, 255);
                    dump("Это не массив");
                }
                dump("-------------------------");
//                foreach ($item as $key => $val) {
//                    dump($key);
//                    dump($val);
//                }
            }
        }
    }

    private function create($entityId, $name, $type, $maxLength): string {
        $entityField  = EntityField::create([
            //'id' => $id,
            'entity_id' => $entityId,
            'name' => $name,
            'type' => $type,
            'max_length' => $maxLength
        ]);

        return $entityField->id;
    }
}
