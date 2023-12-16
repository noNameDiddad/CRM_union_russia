<?php

namespace Database\Seeders;

use App\Data\FieldFilterData;
use App\Models\FieldFilter;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class FieldFilterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run($entity_id, $filterName, $json): void
    {
        $filter = FieldFilterData::from(
            $this->reformatJson($json) +
            ['name' => $filterName, 'entity_id' => $entity_id]
        );
        FieldFilter::create($filter->toArray());
    }

    private function reformatJson($json): array
    {
        $result = [];
        foreach ($json['fields'] as $key => $item) {
            $result['fields'][Str::slug($key)] = $item;
        }

        return $result;
    }
}
