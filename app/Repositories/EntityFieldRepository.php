<?php

namespace App\Repositories;


use App\Models\Entity;
use App\Models\EntityField;
use App\Models\EntityValue;
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

    public function getFields(string $entity_id): array
    {
        return $this->model->where('entity_id', $entity_id)->pluck('name')->toArray();
    }
}
