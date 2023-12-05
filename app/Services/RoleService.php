<?php

namespace App\Services;

use App\Repositories\EntityFieldRepository;
use App\Repositories\RoleRepository;

class RoleService
{
    use CRUDMethods;
    /**
     * @var EntityFieldRepository
     */
    private mixed $repository;

    public function __construct()
    {
        $this->repository = app(RoleRepository::class);
    }
}
