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
        dump('Выберите способ заполнения');
        $seedType = $this->command->ask('1 - старая структура, 2 - с разделенными полями, 3 - со связанными полями');

        $dirName = '';
        switch ($seedType) {
            case 1:
                $dirName = '__import';
                break;
            case 2:
                $dirName = '__import_selected';
                break;
            case 3:
                $dirName = '__import_selected_typeof';
                break;
            default:
                return;
        }

        $files = File::files($dirName);

        dump('Началось заполнение данных, при возникновении ошибки убедитесь что данные в файлах в формате JSON');
        dump('Сделать это можно с помощью валидатора, например, https://codebeautify.org/jsonviewer');

        foreach ($files as $file) {
            if ($file->getExtension() === 'json') {
                $this->seedEntity('./' . $dirName . '/' . $file->getFilename());
            }
        }
    }

    private function seedEntity(String $path): void {
        $json = File::json(base_path($path));

        $entityName = null;
        foreach($json as $name => $value) {
            $entityName = $name;
        }

        $this->call(
            [
                EntitySeeder::class,
                EntityFieldSeeder::class,
            ],
            false,
            [
                'entityName' => $entityName,
                'json' => $json
            ],
        );
    }
}
