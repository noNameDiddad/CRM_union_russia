<?php

namespace App\Services;


use App\Helpers\FieldFilterHelper;
use App\Models\Entity;
use App\Repositories\EntityFieldRepository;

class EntityFieldsService
{
    use CRUDMethodsForEntity;
    /**
     * @var EntityFieldRepository
     */
    private mixed $repository;

    public function __construct()
    {
        $this->repository = app(EntityFieldRepository::class);
    }

    public function getAllByEntity(Entity $entity): array
    {
        $data = $this->repository->allByEntity($entity);

        return FieldFilterHelper::filterData($data,$entity->id);
    }
}
