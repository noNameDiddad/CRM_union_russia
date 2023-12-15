<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class StatisticFormat extends Model
{
    use HasUuids;

    protected $keyType = 'string';

    protected $fillable = ['id', 'name', 'hash'];
}
