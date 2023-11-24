<?php

namespace App\Services;

use App\Repositories\EntityRepository;
use Illuminate\Database\Eloquent\Model;

class EntityService
{
    use CRUDMethods;
    /**
     * @var EntityRepository
     */
    private mixed $repository;

    public function __construct()
    {
        $this->repository = app(EntityRepository::class);
    }

    public function create(array $data): Model
    {
        return $this->repository->create($data);
    }

    public function update(string $id, array $data): Model
    {
        return $this->repository->update($data, $id);
    }
}
