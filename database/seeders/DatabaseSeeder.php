<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $dirName = '__import';


        if (File::exists($dirName . '/roles.json')) {
            $roles = File::json($dirName . '/roles.json');
            $this->call(
                [
                    RoleSeeder::class,
                ],
                false,
                [
                    'json' => $roles
                ],
            );
        }

        if (File::exists($dirName . '/statistics.json')) {
            $formats = File::json($dirName . '/statistics.json');
            $this->call(
                [
                    StatisticFormatSeeder::class,
                ],
                false,
                [
                    'formats' => $formats
                ],
            );
        }


        if (File::exists($dirName . '/order.json')) {
            $order = File::json($dirName . '/order.json');
        }

        foreach ($order['order'] as $item) {
            if (File::exists($dirName . '/data/'.$item.'.json')) {
                $this->seedEntity($dirName . '/data/'.$item.'.json', $item);
            }

        }
    }

    private function seedEntity(string $path, $hash): void
    {
        $json = File::json(base_path($path));

        dump('Обработка файла ' . $path . '.' );

        foreach ($json as $name => $value) {
            $entityName = $name;
            $this->call(
                [
                    EntitySeeder::class,
                ],
                false,
                [
                    'entityName' => $entityName,
                    'json' => $value,
                    'hash' => $hash
                ],
            );
        }
    }
}
