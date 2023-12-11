<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model as StandardModel;


trait CRUDMethods
{
    public function getAll()
    {
        return $this->repository->all();
    }

    public function create(array $data): StandardModel
    {
        return $this->repository->create($data);
    }

    public function update(string $id, array $data):  StandardModel
    {
        return $this->repository->update($data, $id);
    }

    public function delete(string $id): bool
    {
        return $this->repository->delete($id);
    }

    public function show(string $id): StandardModel|null
    {
        return $this->repository->findOrFail($id);
    }
}
