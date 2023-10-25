<?php

namespace App\Repositories;

use App\Models\Entity;
use App\Models\EntityValue;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class EntityValueRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class EntityValueRepository
{
    private EntityValue $model;

    public function __construct()
    {
        $this->model = new EntityValue();
    }

    public function allByEntity(Entity $entity): Collection
    {
        return $this->model->where('entity_id', $entity->id)->get();
    }

    public function create(array $data): EntityValue
    {
        return $this->model->create($data);
    }

    public function update(string $id, array $data): EntityValue
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

    public function findOrFail(string $id): ?EntityValue
    {
        return $this->model->findOrFail($id);
    }
}
