<?php

namespace App\Helpers;

use App\Repositories\EntityFieldRepository;

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

    public function getFields(string $entity_id, bool $isStatistic = false): array
    {
        if ($isStatistic) {
            $fields = $this->repository->getFieldsForStatistic($entity_id);
        } else {
            $fields = $this->repository->getFields($entity_id);
        }

        $data = [];

        foreach ($fields as $field) {
            $data[$field->hash] = $field->type;
        }

        return $data;
    }
}
