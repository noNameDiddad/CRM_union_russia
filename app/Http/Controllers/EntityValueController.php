<?php

namespace App\Http\Controllers;

use App\Http\Requests\EntityValueRequest;
use App\Http\Resources\EntityValueResource;
use App\Http\Resources\EntityValueWithChapters;
use App\Models\Entity;
use App\Models\EntityValue;
use App\Services\EntityValueService;

class EntityValueController extends Controller
{

    private EntityValueService $service;

    public function __construct()
    {
        $this->authorizeResource(EntityValue::class, 'EntityValue');
    }

    public function index(Entity $entity)
    {
        $this->service = new EntityValueService($entity);
        return EntityValueResource::collection($this->service->getAllByEntity($entity));
    }

    public function store(EntityValueRequest $request, Entity $entity)
    {
        $this->service = new EntityValueService($entity);
        return new EntityValueResource($this->service->createWithFieldResolver($entity, $request->all()));
    }

    public function show(Entity $entity, string $entity_value)
    {
        $this->service = new EntityValueService($entity);
        return new EntityValueResource($this->service->show($entity_value), false);
    }

    public function update(EntityValueRequest $request, Entity $entity, string $entity_value)
    {
        $this->service = new EntityValueService($entity);
        return new EntityValueResource($this->service->updateWithFieldResolver($entity, $entity_value, $request->all()));
    }

    public function destroy(Entity $entity, string $entity_value)
    {
        $this->service = new EntityValueService($entity);
        $this->service->delete($entity_value);
        return response()->json();
    }
}
