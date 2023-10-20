<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntityField extends Model
{
    use HasFactory;

    protected $table = 'entity_fields';
    protected $guarded = false;

    public function entityValue() {
        return $this->hasOne(EntityValue::class, 'instance_id', 'id');
    }
}
