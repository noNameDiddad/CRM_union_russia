<?php

namespace App\Http\Resources;

use App\Enums\FieldTypeEnum;
use App\Helpers\EntityFieldHelper;
use App\Models\EntityField;
use App\Repositories\EntityFieldFixedValueRepository;
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
        $typeArray = [
            FieldTypeEnum::Stage->value,
            FieldTypeEnum::Select->value,
            FieldTypeEnum::MultiSelect->value,
            FieldTypeEnum::Object->value,
        ];
        if (in_array($this->type, $typeArray)) {
            $entity_field_fixed_value = [];
            $entity_field_fixed_value_collection = app(EntityFieldFixedValueRepository::class)->allByEntityFieldsById($this->id);

            foreach ($entity_field_fixed_value_collection as $item) {
                $entity_field_fixed_value[$item->value] = $item->id;
            }
        }

        return [
            'id' => $this->id,
            'entity_id' => $this->entity_id,
            'relate_to' => $this->relate_to,
            'name' => $this->name,
            'type' => $this->type,
            'hash' => $this->hash,
            'entity_field_fixed_value'=> $entity_field_fixed_value ?? [],
            'in_stat' => $this->in_stat,
            'max_length' => $this->max_length,
            'created_at' => $this->created_at
        ];
    }
}
