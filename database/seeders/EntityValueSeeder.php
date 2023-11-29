<?php

namespace Database\Seeders;

use App\Helpers\EntityValueSeederHelper;
use App\Models\Entity;
use App\Models\EntityField;
use App\Models\EntityValue;
use App\Services\EntityValueService;
use App\Services\FieldTypeService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EntityValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run($entity, $fields): void
    {
        $entity_table = "table_" . $entity->hash;
        $service = new EntityValueService($entity_table);
        $service->truncate();
        for ($i = 0; $i < 100; $i++) {
            $service->createWithFieldResolver($entity, $this->generateData($entity, $fields));
        }
    }

    private function generateData($entity, $fields):array
    {
        return EntityValueSeederHelper::generateData($entity->id, $fields);
    }
}
