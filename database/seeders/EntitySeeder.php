<?php

namespace Database\Seeders;

use App\Models\Entity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EntitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run($entityName): void
    {
        $maxUniqueId =  Entity::latest()->first()->id ?? 0;

        Entity::create([
            //'id' => $maxUniqueId + 1,
            'name' => $entityName
        ]);
    }
}
