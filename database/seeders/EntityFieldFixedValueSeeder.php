<?php

namespace Database\Seeders;

use App\Models\Entity;
use App\Models\EntityField;
use App\Models\EntityFieldFixedValue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EntityFieldFixedValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run($entityFieldId, $fieldNames): void
    {
       dump($entityFieldId);
       dump($fieldNames);
       EntityFieldFixedValue::create([
           'entity_field_id' => $entityFieldId,
           'value' => $fieldNames,
       ]);
    }
}
