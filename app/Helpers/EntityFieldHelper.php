<?php

namespace App\Helpers;

use App\Repositories\EntityFieldRepository;
use Illuminate\Database\Eloquent\Collection;

class EntityFieldHelper
{
    /**
     * @var EntityFieldRepository
     */
    private mixed $repository;

    public function __construct()
    {
        $this->repository = app(EntityFieldRepository::class);
    }

    public static function sortFieldsByPriority(Collection $data, $entity_id): Collection
    {
        $fields = app(EntityFieldHelper::class)->getFields($entity_id);
        foreach ($fields as $key => $field) {
            if ($field['type'] == 'priority') {
                return $data->sortBy($key);
            }
        }
        return $data;
    }

    public function getFields(string $entity_id, bool $isStatistic = false): array
    {
        if ($isStatistic) {
            $fields = $this->repository->getFieldsForStatistic($entity_id);
        } else {
            $fields = $this->repository->getFields($entity_id);
        }

        $data = [];

        foreach ($fields as $field) {
            $data[$field->hash] = [
                'type' => $field->type,
                'relateTo' => $field->relate_to
            ];
        }

        return $data;
    }
}
