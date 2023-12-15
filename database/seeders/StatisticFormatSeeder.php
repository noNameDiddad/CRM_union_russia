<?php

namespace Database\Seeders;


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
            StatisticFormat::create([
                'action' => $item,
                'hash' => $hash,
                'format' => json_encode(reset($value))
            ]);
        }
    }
}
