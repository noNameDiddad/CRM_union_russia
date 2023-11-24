<?php

namespace App\Helpers;

use App\Models\Entity;
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

    public function getFields(string $entity_id): array
    {
        $fields = $this->repository->getFields($entity_id);

        $data = [];

        foreach ($fields as $field) {
            $data[$field->name] = $field->type;
        }

        return $data;
    }

}
