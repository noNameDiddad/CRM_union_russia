<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class EntityValue extends Model
{
    use HasFactory;

    protected $table = 'entity_values';
    protected $guarded = false;

    public function entityField() {
        return $this->belongsTo(EntityField::class, 'instance_id', 'id');
    }
}
