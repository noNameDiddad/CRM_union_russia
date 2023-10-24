<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use MongoDB\Laravel\Schema\Blueprint;

return new class extends Migration
{
    protected $connection = 'mongodb';
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('entity_values', function (Blueprint $table) {
            $table->id();
            $table->integer('unique_id');
            $table->foreignId('entity_id')->index()->constrained('entities');
            $table->foreignId('instance_id')->index()->constrained('entity_fields');
            $table->json('value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entity_values');
    }
};
