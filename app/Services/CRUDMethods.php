<?php

namespace App\Services;

use App\Models\Entity;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model as StandardModel;
use MongoDB\Laravel\Eloquent\Model as MongoModel;


trait CRUDMethods
{
    public function getAllByEntity(Entity $entity): Collection
    {
        return $this->repository->allByEntity($entity);
    }

    public function getAll()
    {
        return $this->repository->all();
    }

    public function createWithEntity(Entity $entity, array $data): MongoModel|StandardModel
    {
        $data['entity_id'] = $entity->id;

        return $this->repository->create($data);
    }

    public function updateWithEntity(Entity $entity, string $id, array $data):  MongoModel|StandardModel
    {
        $data['entity_id'] = $entity->id;
        return $this->repository->update($data, $id);
    }

    public function delete(string $id): bool
    {
        return $this->repository->delete($id);
    }

    public function show(string $id): MongoModel|StandardModel|null
    {
        return $this->repository->findOrFail($id);
    }
}
