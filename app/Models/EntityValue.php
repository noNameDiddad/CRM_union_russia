<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Eloquent\SoftDeletes;


class EntityValue extends Model
{
    use SoftDeletes, HasUuids;

    protected $keyType = 'string';

    protected $connection = 'mongodb';

    protected $guarded = false;
}
