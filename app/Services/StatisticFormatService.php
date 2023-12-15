<?php

namespace App\Services;

use App\Repositories\EntityFieldRepository;
use App\Repositories\RoleRepository;
use App\Repositories\StatisticFormatRepository;

class StatisticFormatService
{
    use CRUDMethods;
    /**
     * @var EntityFieldRepository
     */
    private mixed $repository;

    public function __construct()
    {
        $this->repository = app(StatisticFormatRepository::class);
    }
}
