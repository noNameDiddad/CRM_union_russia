<?php

namespace App\Http\Resources;

use App\Helpers\EntityFieldHelper;
use App\Models\Entity;
use App\Services\FieldTypeService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

class EntityValueWithChapters extends JsonResource
{
    protected Collection $chapters;

    public function __construct($resource, private Entity $entity)
    {
        parent::__construct($resource);
        $this->chapters = collect($entity->chapters)->sortBy('order');
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $fields = app(EntityFieldHelper::class)->getFields($this->entity_id, false);
        $data = [];
        foreach ($this->chapters as $chapter) {
            $specialData = [];
            if ($chapter->special_fields !== null) {
                foreach ($chapter->special_fields as $key => $special_field) {
                    foreach ($special_field as $item) {
                        $params = explode(".", $item);
                        if ($params[0] == "this") {
                            $field = $fields[$params[1]];
                            $fieldClass = FieldTypeService::getClassForFieldType($field['type']);
                            $specialData[$key][$params[1]] = app($fieldClass)->get(
                                $this->{$params[1]},
                                $field,
                                true,
                                $this->resource
                            );
                        } elseif ($params[0] == "parent") {
                            $fieldKey = collect($fields)->where("type", "belongs_to")->keys()->first();
                            $field = $fields[$fieldKey];
                            $fieldClass = FieldTypeService::getClassForFieldType($field['type']);
                            $response = app($fieldClass)->get(
                                $this->{$fieldKey},
                                $field,
                                false,
                                $this->resource
                            );
                            $specialData[$key][$params[1]] = $response[$params[1]];
                        } else {
                            $fieldKey = collect($fields)->where("relateTo", $params[0])->keys()->first();
                            $fieldClass = FieldTypeService::getClassForFieldType($field['type']);
                            $response = app($fieldClass)->get(
                                $this->{$fieldKey},
                                $fields[$fieldKey],
                                false,
                                $this->resource
                            );
                            $specialData[$key][$params[1]] = $response[$params[1]];
                        }
                    }
                }
            }
            foreach ($chapter->fields as $item) {
                $params = explode(".", $item);
                if ($params[0] == "this") {
                    if (isset($chapter->special_fields[$params[1]])) {
                        $data[$chapter->name][$params[1]] = $specialData[$params[1]];
                    } else {
                        $field = $fields[$params[1]];
                        $fieldClass = FieldTypeService::getClassForFieldType($field['type']);
                        $data[$chapter->name][$params[1]] = app($fieldClass)->get(
                            $this->{$params[1]},
                            $field,
                            true,
                            $this->resource
                        );
                    }
                } else {
                    $fieldKey = collect($fields)->where("relateTo", $params[0])->keys()->first();
                    $fieldClass = FieldTypeService::getClassForFieldType($field['type']);
                    $response = app($fieldClass)->get($this->{$fieldKey}, $fields[$fieldKey], false, $this->resource);
                    $data[$chapter->name][$params[1]] = $response[$params[1]];
                }
            }
        }
        return $data;
    }
}
