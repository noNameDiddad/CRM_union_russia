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

    public function __construct($table)
    {
        $this->model = app(EntityValue::class)->setTable($table);
    }

    public function allByEntity(Entity $entity): Collection
    {
        return $this->model->where('entity_id', $entity->id)->get();
    }

    public function create(array $data): EntityValue
    {
        return $this->model->create($data);
    }

    public function update( array $data, string $id): EntityValue
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

    public function randomId($count)
    {
        $all_id = collect($this->model->where('_id', 'exists', true)->get()->toArray());
        return $all_id->pluck('_id')->random($count);
    }

    public function truncate(): void
    {
        $this->model->truncate();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }
}
