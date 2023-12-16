<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    use HasFactory, HasUuids;

    protected $keyType = 'string';

    protected $fillable = ['id', 'name', 'hash'];

    public function field_filter()
    {
        return $this->hasOne(FieldFilter::class);
    }
    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }
}
