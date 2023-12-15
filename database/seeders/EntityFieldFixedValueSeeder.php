<?php

namespace Database\Seeders;

use App\Data\EntityFieldFixedValueData;
use App\Models\EntityFieldFixedValue;
use Illuminate\Database\Seeder;

class EntityFieldFixedValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run($entityFieldId, $fieldNames): void
    {
        dump($entityFieldId);
        dump($fieldNames);

        foreach ($fieldNames as $fieldName) {
            $entityFieldFixedValue = EntityFieldFixedValueData::from([
                'entity_field_id' => $entityFieldId,
                'value' => $fieldName,
            ]);
            EntityFieldFixedValue::create($entityFieldFixedValue->toArray());
        };
    }
}
