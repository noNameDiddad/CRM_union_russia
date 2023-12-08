<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasUuids;

    protected $keyType = 'string';
    protected $fillable = [
        'permissions',
        'hash',
        'role_id',
    ];

    protected $casts = [
        'permissions' => 'array',
    ];
}
