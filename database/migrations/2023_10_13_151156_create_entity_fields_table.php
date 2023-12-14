<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('entity_fields', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('entity_id')->references('id')->on('entities');
            $table->string('name');
            $table->string('type');
            $table->string('hash');
            $table->json('rules')->nullable();
            $table->boolean('in_stat');
            $table->string('sub_type')->nullable();
            $table->integer('max_length');
            $table->string('relate_to')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entity_fields');
    }
};
