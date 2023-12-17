<?php

namespace App\Repositories;


use App\Models\Entity;
use App\Models\EntityFieldFixedValue;
use App\Models\EntityField;
use Illuminate\Database\Eloquent\Collection;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class EntityFieldRepository.
 *
 * @package namespace App\Repositories;
 */
class EntityFieldFixedValueRepository extends BaseRepository
{
    public function model()
    {
        return EntityFieldFixedValue::class;
    }

    public function allByEntityFields(EntityField $entity_field): Collection
    {
        return $this->model->where('entity_field_id', $entity_field->id)->get();
    }

    public function allByEntityFieldsById(string $entity_field_id): Collection
    {
        return $this->model->where('entity_field_id', $entity_field_id)->get();
    }

}

