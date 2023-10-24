<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class EntityValue extends Model
{
    protected $connection = 'mongodb';

    protected $table = 'entity_values';
    protected $guarded = false;
}
