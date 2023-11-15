<?php

namespace App\Http\Resources;

use App\Helpers\EntityFieldHelper;
use App\Models\EntityField;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EntityFieldResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'entity_id' => $this->entity_id,
            'name' => $this->name,
            'type' => $this->type,
            'type_of' => $this->type_of,
            'max_length' => $this->max_length,
            'created_at' => $this->created_at
        ];
    }
}
