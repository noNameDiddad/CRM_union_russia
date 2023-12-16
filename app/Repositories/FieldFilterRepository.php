<?php

namespace App\Repositories;

use App\Models\FieldFilter;
use Prettus\Repository\Eloquent\BaseRepository;

class FieldFilterRepository extends BaseRepository
{
    public function model()
    {
        return FieldFilter::class;
    }

    public function findByEntityId(string $entityId): FieldFilter
    {
        return $this->model->where('entity_id', $entityId)->first();
    }

}
