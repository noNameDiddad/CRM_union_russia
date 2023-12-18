<?php

namespace App\Services;


use App\Models\Entity;
use App\Repositories\EntityValueRepository;

class EntityValueService
{
    use CRUDMethodsForEntity;
    /**
     * @var EntityValueRepository
     */
    private mixed $repository;
    private mixed $table;

    public function __construct($table)
    {
        $this->repository = new EntityValueRepository($table);
    }

    public function createWithFieldResolver(Entity $entity, array $data)
    {
        $data['entity_id'] = $entity->id;

        $resolvedData = app(FieldTypeService::class)->dataFieldTypeResolve($data);
        return $this->repository->create($resolvedData);
    }


    public function updateWithFieldResolver(Entity $entity, string $id, array $data)
    {
        $data['entity_id'] = $entity->id;

        $resolvedData = app(FieldTypeService::class)->dataFieldTypeResolve($data);
        return $this->repository->update($resolvedData, $id);
    }

    public function getRandomElement($count = 1)
    {
        return $this->repository->randomId($count);
    }

    public function truncate(): void
    {
        $this->repository->truncate();
    }

    public function getRecord($entity, $recordId): ?array
    {
        return $this->repository->allByEntity($entity)->where('_id', $recordId)->toArray();
    }

    public function updateFile($data, $entity_value): EntityValue
    {
        return $this->repository->update($data, $entity_value);
    }
}
