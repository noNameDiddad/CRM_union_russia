<?php

namespace App\Http\Resources;

use App\Helpers\EntityFieldHelper;
use App\Repositories\EntityFieldRepository;
use App\Repositories\EntityRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EntityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $fields = app(EntityFieldHelper::class)->getFields($this->id);
        $fields = collect($fields)->whereNotNull("relateTo");
        if ($fields->count() != 0) {
            $subEntities = [];
            foreach ($fields as $field) {
                $subEntities[$field['relateTo']] = app(EntityRepository::class)->where('hash', $field['relateTo'])->first()->id;
            }
        }



        return [
            'id' => $this->id,
            'name' => $this->name,
            'hash' => $this->hash,
            'subEntities' => $subEntities ?? [],
            'is_kanban' => $this->is_kanban,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
