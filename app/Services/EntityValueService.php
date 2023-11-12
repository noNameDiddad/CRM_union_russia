<?php

namespace App\Services;


use App\Models\Entity;
use App\Repositories\EntityValueRepository;

class EntityValueService
{
    use CRUDMethods;
    /**
     * @var EntityValueRepository
     */
    private mixed $repository;
    private mixed $table;

    public function __construct($table)
    {
        $this->repository = new EntityValueRepository($table);
    }
}
