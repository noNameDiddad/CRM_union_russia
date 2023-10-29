<?php

namespace App\Repositories;

use App\Models\Entity;
use App\Models\EntityValue;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class EntityRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class EntityRepository
{
    private Entity $model;

    public function __construct()
    {
        $this->model = new Entity();
    }

    public function all(): Collection
    {
        return $this->model->all();
    }

    public function create(array $data): Entity
    {
        return $this->model->create($data);
    }

    public function update(string $id, array $data): Entity
    {
        $entity = $this->model->findOrFail($id);
        $entity->update($data);
        return $entity;
    }

    public function delete(string $id): bool
    {
        $entity = $this->findOrFail($id);
        return $entity->delete();
    }

    public function findOrFail(string $id): ?Entity
    {
        return $this->model->findOrFail($id);
    }
}
