<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntityFieldFixedValue extends Model
{
    use HasFactory, HasUuids;
    protected $keyType = 'string';
    protected $fillable = ['id', 'entity_field_id', 'value'];
}
