<?php

namespace App\Repositories;


use App\Models\Entity;
use App\Models\EntityField;
use Illuminate\Database\Eloquent\Collection;

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

    public function update(int $id, array $data): bool
    {
        $EntityField = $this->findOrFail($id);
        return $EntityField->update($data);
    }

    public function delete(int $id): bool
    {
        $EntityField = $this->findOrFail($id);
        return $EntityField->delete();
    }

    public function findOrFail(int $id): ?EntityField
    {
        return $this->model->findOrFail($id);
    }
}
