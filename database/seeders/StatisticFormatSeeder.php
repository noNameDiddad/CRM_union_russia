<?php

namespace Database\Seeders;


use App\Models\Entity;
use App\Models\StatisticFormat;
use App\Services\StatisticFormatService;
use Illuminate\Database\Seeder;

class StatisticFormatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run($formats): void
    {
        foreach ($formats as $item => $value) {
            $hash = key($value);
            $entity = Entity::where('hash', $hash)->first();
            StatisticFormat::create([
                'action' => $item,
                'entity_id' => $entity->id,
                'format' => json_encode(reset($value))
            ]);
        }
    }
}
