<?php

namespace App\Http\Resources;

use App\Data\EntityValueFieldGetData;
use App\Enums\FieldTypeEnum;
use App\Helpers\EntityFieldHelper;
use App\Helpers\EntityValueHelper;
use App\Models\Entity;
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
                            $specialData[$key][$params[1]] = EntityValueHelper::getValueByField(
                                new EntityValueFieldGetData(
                                    field: $field,
                                    value: $this->{$params[1]},
                                    currentEntityValue: $this->resource,
                                    isFormatted: true

                                )
                            );
                        } elseif ($params[0] == "parent") {
                            $fieldKey = collect($fields)->where("type", FieldTypeEnum::BelongsTo->value)->keys()->first();
                            $field = $fields[$fieldKey];
                            $response = EntityValueHelper::getValueByField(
                                new EntityValueFieldGetData(
                                    field: $field,
                                    value: $this->{$fieldKey},
                                    currentEntityValue: $this->resource
                                )
                            );
                            $specialData[$key][$params[1]] = $response[$params[1]];
                        } else {
                            $fieldKey = collect($fields)->where("relateTo", $params[0])->keys()->first();
                            $response = EntityValueHelper::getValueByField(
                                new EntityValueFieldGetData(
                                    field: $field,
                                    value: $this->{$fieldKey},
                                    currentEntityValue: $this->resource
                                )
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
                        if (is_array($this->{$params[1]})) {
                            $value = json_encode($this->{$params[1]});
                        } else {
                            $value = $this->{$params[1]};
                        }
                        $data[$chapter->name][$params[1]] =  EntityValueHelper::getValueByField(
                            new EntityValueFieldGetData(
                                field: $field,
                                value: $value,
                                currentEntityValue: $this->resource,
                                isFormatted: true

                            )
                        );
                    }
                } else {
                    $fieldKey = collect($fields)->where("relateTo", $params[0])->keys()->first();
                    $response = EntityValueHelper::getValueByField(
                        new EntityValueFieldGetData(
                            field: $fields[$fieldKey],
                            value: $this->{$fieldKey},
                            currentEntityValue: $this->resource
                        )
                    );
                    $data[$chapter->name][$params[1]] = $response[$params[1]];
                }
            }
        }
        return $data;
    }
}
