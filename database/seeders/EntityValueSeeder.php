<?php

namespace Database\Seeders;

use App\Helpers\EntityValueSeederHelper;
use App\Services\EntityValueService;
use Illuminate\Database\Seeder;

class EntityValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run($entity, $fields): void
    {
        $service = new EntityValueService($entity);
        $service->truncate();
        for ($i = 0; $i < 100; $i++) {
            $service->createWithFieldResolver($entity, $this->generateData($fields));
        }
    }

    private function generateData($fields):array
    {
        return EntityValueSeederHelper::generateData($fields);
    }
}
