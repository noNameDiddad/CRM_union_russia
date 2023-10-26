<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Eloquent\SoftDeletes;


class EntityValue extends Model
{
    use SoftDeletes;

    protected $keyType = 'string';

    protected $connection = 'mongodb';

    protected $guarded = false;
}
