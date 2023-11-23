<?php

namespace App\Services;


use App\Models\Entity;
use App\Repositories\EntityValueRepository;

class EntityValueService
{
    use CRUDMethods;
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
}
