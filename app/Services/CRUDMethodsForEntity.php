<?php

namespace App\Services;

use App\Helpers\EntityFieldHelper;
use App\Models\Entity;
use App\Models\EntityValue;
use Illuminate\Database\Eloquent\Collection;


trait CRUDMethodsForEntity
{
    public function getAllByEntity(Entity $entity): Collection
    {
        $data = $this->repository->allByEntity($entity);
        return EntityFieldHelper::sortFieldsByPriority($data, $entity->id);
    }

    public function createWithEntity(Entity $entity, array $data): Entity|EntityValue
    {
        $data['entity_id'] = $entity->id;

        return $this->repository->create($data);
    }

    public function updateWithEntity(Entity $entity, string $id, array $data):  Entity|EntityValue
    {
        $data['entity_id'] = $entity->id;
        return $this->repository->update($data, $id);
    }

    public function delete(string $id): bool
    {
        return $this->repository->delete($id);
    }

    public function show(string $id): Entity|EntityValue|null
    {
        return $this->repository->findOrFail($id);
    }
}
