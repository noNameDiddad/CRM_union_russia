<?php

namespace App\Repositories;

use App\Models\Entity;
use App\Models\EntityValue;
use Illuminate\Database\Eloquent\Collection;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class EntityRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class EntityRepository extends BaseRepository
{
    public function model()
    {
        return Entity::class;
    }
}
