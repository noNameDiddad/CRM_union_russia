<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model as StandardModel;
use MongoDB\Laravel\Eloquent\Model as MongoModel;
use App\Repositories\EntityRepository;

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

    public function create(array $data): MongoModel|StandardModel
    {
        return $this->repository->create($data);
    }

    public function update(string $id, array $data):  MongoModel|StandardModel
    {
        return $this->repository->update($id, $data);
    }
}
