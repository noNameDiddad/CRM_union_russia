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
class EntityFieldRepository
{

    private EntityField $model;

    public function __construct()
    {
        $this->model = new EntityField();
    }


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

    public function create(array $data): EntityField
    {
        return $this->model->create($data);
    }

    public function update(string $id, array $data): EntityField
    {
        $entityValue = $this->model->findOrFail($id);
        $entityValue->update($data);
        return $entityValue;
    }

    public function delete(string $id): bool
    {
        $entityValue = $this->findOrFail($id);
        return $entityValue->delete();
    }

    public function findOrFail(string $id): ?EntityField
    {
        return $this->model->findOrFail($id);
    }
}