<?php

namespace App\Services;

use App\Repositories\EntityRepository;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class UserService
{
    use CRUDMethods;
    /**
     * @var UserRepository
     */
    private mixed $repository;

    public function __construct()
    {
        $this->repository = app(UserRepository::class);
    }
}
