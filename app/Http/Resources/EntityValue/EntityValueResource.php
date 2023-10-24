<?php

namespace App\Http\Resources\EntityValue;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EntityValueResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'unique_id' => $this->unique_id,
            'entity_id' => $this->entity_id,
            'instance_id' => $this->instance_id,
            'value' => $this->value,
        ];
    }
}
