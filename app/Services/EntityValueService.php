<?php

namespace App\Services;


use App\Helpers\EntityFieldHelper;
use App\Models\Entity;
use App\Repositories\EntityValueRepository;

class EntityValueService
{
    use CRUDMethodsForEntity;
    /**
     * @var EntityValueRepository
     */
    public mixed $repository;
    private mixed $table;

    public function __construct(private Entity $entity)
    {
        $entity_table = "table_" . $entity->hash;
        $this->repository = new EntityValueRepository($entity_table);
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

        $resolvedData = app(FieldTypeService::class)->dataFieldTypeResolve($data, 'update');
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

    public function find($id)
    {
        return $this->repository->find($id);
    }
    public function getAllByParent($parent_entity_hash, $id)
    {
        $fields = app(EntityFieldHelper::class)->getFields($this->entity->id);
        $needleField =collect($fields)
            ->where("type", "belongs_to")
            ->where("relateTo", $parent_entity_hash)->keys()->first();
        return $this->repository->getWhere($needleField, $id);
    }
}
