<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory, HasUuids;

    protected $keyType = 'string';

    protected $fillable = ['id', 'name', 'special_fields','fields', 'is_sub_entity', 'entity_id', 'order'];

    protected $casts = [
        "special_fields" => "array",
        "fields" => "array",
    ];
}
