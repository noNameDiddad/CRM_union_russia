<?php

namespace App\Services;

use App\Repositories\EntityRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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

    public function getFiltered()
    {
        return $this->repository->where('is_sub_entity', false)->get();
    }

    public function create(array $data): Model
    {
        $data['hash'] = Str::slug($data['name']);
        return $this->repository->create($data);
    }

    public function update(string $id, array $data): Model
    {
        return $this->repository->update($data, $id);
    }

    public static function getByHash($hash)
    {
        return app(EntityRepository::class)->where('hash', $hash)->first();
    }
    public static function getById($id)
    {
        return app(EntityRepository::class)->where('id', $id)->first();
    }
}
