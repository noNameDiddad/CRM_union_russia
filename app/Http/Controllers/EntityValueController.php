<?php

namespace App\Http\Controllers;

use App\Http\Requests\EntityValueRequest;
use App\Http\Resources\EntityValueResource;
use App\Models\Entity;
use App\Services\EntityValueService;

class EntityValueController extends Controller
{

    private EntityValueService $service;

    public function index(Entity $entity)
    {
        $entity_table = "table_" . $entity->hash;
        $this->service = new EntityValueService($entity_table);
        return EntityValueResource::collection($this->service->getAllByEntity($entity));
    }

    public function store(EntityValueRequest $request, Entity $entity)
    {
        $entity_table = "table_" . $entity->hash;
        $this->service = new EntityValueService($entity_table);
        return new EntityValueResource($this->service->createWithFieldResolver($entity, $request->all()));
    }

    public function show(Entity $entity, string $entity_value)
    {
        $entity_table = "table_" . $entity->hash;
        $this->service = new EntityValueService($entity_table);
        return new EntityValueResource($this->service->show($entity_value));
    }

    public function update(EntityValueRequest $request, Entity $entity, string $entity_value)
    {
        $entity_table = "table_" . $entity->hash;
        $this->service = new EntityValueService($entity_table);
        return new EntityValueResource($this->service->updateWithEntity($entity, $entity_value, $request->all()));
    }

    public function destroy(Entity $entity, string $entity_value)
    {
        $entity_table = "table_" . $entity->hash;
        $this->service = new EntityValueService($entity_table);
        $this->service->delete($entity_value);
        return response()->json();
    }
}
