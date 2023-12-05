<?php

namespace App\Services;


use App\Models\EntityField;
use App\Repositories\EntityFieldFixedValueRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class EntityFieldFixedValueService
{
    use CRUDMethodsForEntity;
    /**
     * @var EntityFieldFixedValueRepository
     */
    private mixed $repository;

    public function __construct()
    {
        $this->repository = app(EntityFieldFixedValueRepository::class);
    }

    public function allByEntityFields(EntityField $entity_field): Collection
    {
        return $this->repository->allByEntityFields($entity_field);
    }

    public function createWithEntityField(EntityField $entity_field, array $data): Model
    {
        $data['entity_field_id'] = $entity_field->id;
        return $this->repository->create($data);
    }

    public function updateWithEntityField(EntityField $entity_field, string $id, array $data):  Model
    {
        $data['entity_field_id'] = $entity_field->id;
        return $this->repository->update($data, $id);
    }

}
