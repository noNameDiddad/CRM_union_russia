<?php

namespace App\Services;

use App\Models\FieldFilter;
use App\Repositories\FieldFilterRepository;

class FieldFilterService
{
    use CRUDMethods;
    private mixed $repository;

    public function __construct()
    {
        $this->repository = app(FieldFilterRepository::class);
    }

    public function show($id)
    {
        return $this->repository->findByEntityId($id);
    }

    public function updateByEntityId(string $entity_id, array $all): FieldFilter
    {
        $filter_id = $this->repository->where('entity_id', $entity_id)->first()->id;
        return $this->repository->update($all, $filter_id);
    }

//    public function filter()
//    {
//        auth()->user()->filters;
//    }
//
//    public function getFilterByEntityHash($entityHash)
//    {
//
//    }
}