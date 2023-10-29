<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntityField extends Model
{
    use HasFactory;

    protected $keyType = 'string';

    protected $fillable = ['id', 'entity_id', 'name', 'type', 'max_length'];

}
