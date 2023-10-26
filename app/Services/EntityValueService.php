<?php

namespace App\Services;


use App\Repositories\EntityValueRepository;

class EntityValueService
{
    use CRUDMethods;
    /**
     * @var EntityValueRepository
     */
    private mixed $repository;

    public function __construct()
    {
        $this->repository = app(EntityValueRepository::class);
    }
}
