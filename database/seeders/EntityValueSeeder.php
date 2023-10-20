<?php

namespace Database\Seeders;

use App\Models\Entity;
use App\Models\EntityField;
use App\Models\EntityValue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EntityValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run($entityName, $json): void
    {
        // Получение имени главной сущности
        $entityId = Entity::where('name', $entityName)->first()->id;
        // Определение числа уникальных записей (аналог строк в таблице для SQL БД) для последующего инкремента для новой записи
        $maxUniqueId =  EntityValue::latest()->first()->unique_id ?? 0;

        // Парсинг файла структуры
        foreach($json as $name => $value) {
            $entityName = $name;
            dump("Name: ${name}");

            foreach ($value as $item) {
                $maxUniqueId++;
                foreach ($item as $key => $val) {
                    dump($key);
                    dump($val);

                    if(is_array($val)) {
                        $val = json_encode($val);
                    }

                    $instanceId = EntityField::where('name', $key)->first()->id ?? 0;

                    EntityValue::create([
                        'entity_id' => $entityId,
                        'unique_id' => $maxUniqueId,
                        'instance_id' => $instanceId,
                        'value' => $val
                    ]);
                }
            }

        }
    }
}
