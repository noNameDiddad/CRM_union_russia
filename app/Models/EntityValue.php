<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Eloquent\SoftDeletes;


class EntityValue extends Model
{
    use SoftDeletes, HasUuids;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    protected $keyType = 'string';

    protected $connection = 'mongodb';

    protected $table = 'armenian_typical_homo';

    protected $guarded = false;
}
