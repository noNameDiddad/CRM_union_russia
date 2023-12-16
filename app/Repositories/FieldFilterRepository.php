<?php

namespace App\Repositories;

use App\Models\Entity;
use App\Models\EntityValue;
use App\Models\FieldFilter;
use Illuminate\Database\Eloquent\Collection;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class EntityRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class FieldFilterRepository extends BaseRepository
{
    public function model()
    {
        return FieldFilter::class;
    }
}
