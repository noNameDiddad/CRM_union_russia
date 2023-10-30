<?php

namespace App\Http\Resources;

use App\Helpers\EntityFieldHelper;
use App\Models\EntityFieldFixedValue;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EntityFieldFixedValueResource extends JsonResource
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
            'entity_field_id' => $this->entity_field_id,
            'value' => $this->value,
        ];
    }
}
