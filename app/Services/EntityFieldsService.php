<?php

namespace App\Services;


use App\Repositories\EntityFieldRepository;

class EntityFieldsService
{
    use CRUDMethods;
    /**
     * @var EntityFieldRepository
     */
    private mixed $repository;

    public function __construct()
    {
        $this->repository = app(EntityFieldRepository::class);
    }
}
