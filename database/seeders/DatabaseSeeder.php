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
        $seedType = $this->command->ask('1 - старая структура, 2(или другой символ)  - структура с разделенными полями');

        $dirName = $seedType === '1' ? '__import' : '__import_selected';

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
