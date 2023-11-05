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
        $this->seedEntity('./__import/contact.json');
        $this->seedEntity('./__import/vacation.json');
        $this->seedEntity('./__import/document.json');
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
