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

    public function getRandomElement($count = 1)
    {
        return $this->repository->randomId($count);
    }

    public function truncate(): void
    {
        $this->repository->truncate();
    }
}
