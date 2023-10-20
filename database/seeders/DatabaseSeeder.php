<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Чтение структуры из файла
        $json = File::json(base_path('./contact.json'));

        // Чтение имен главных сущностей (в данном примере пока одной)
        $entityName = null;
        foreach($json as $name => $value) {
            $entityName = $name;
            //dump($name);
            //dump($value);
        }

        // Вызыв сидеров с передачей данных
        $this->call(
            [
                EntitySeeder::class,
                EntityFieldSeeder::class,
                EntityValueSeeder::class
            ],
            false,
            [
                'entityName' => $entityName,
                'json' => $json
            ],
        );

        dump('Структура засеяна');
    }
}
