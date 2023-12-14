<?php

namespace App\Repositories;


use App\Models\Entity;
use App\Models\EntityField;
use Illuminate\Database\Eloquent\Collection;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class EntityFieldRepository.
 *
 * @package namespace App\Repositories;
 */
class EntityFieldRepository extends BaseRepository
{
    public function model()
    {
        return EntityField::class;
    }

    public function allByEntity(Entity $entity): Collection
    {
        return $this->model->where('entity_id', $entity->id)->get();
    }

    public function getFields(string $entity_id): Collection
    {
        return $this->model->where('entity_id', $entity_id)->get();
    }
    public function getFieldsForStatistic(string $entity_id): Collection
    {
        return $this->model->where('entity_id', $entity_id)->where('in_stat', true)->get();
    }

    public function getFirstStageId(string $entity_id, $stadiaKey):string
    {
        $field =  $this->model->where('entity_id', $entity_id)
            ->where('hash', $stadiaKey)->first();
        return app(EntityFieldFixedValueRepository::class)->where('entity_field_id', $field->id)->first()->id;
    }
}
