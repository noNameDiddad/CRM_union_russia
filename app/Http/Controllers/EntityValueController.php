<?php

namespace App\Http\Controllers;

use App\Http\Requests\EntityValueRequest;
use App\Http\Resources\EntityValueResource;
use App\Models\Entity;
use App\Models\EntityValue;
use App\Services\EntityValueService;
use MongoDB\Model\BSONDocument;

class EntityValueController extends Controller
{

    private EntityValueService $service;

    public function __construct()
    {
        $this->service = new EntityValueService();
    }

    public function index(Entity $entity)
    {
        return EntityValueResource::collection($this->service->getAllByEntity($entity));
    }

    public function store(EntityValueRequest $request, Entity $entity)
    {
        return new EntityValueResource($this->service->createWithEntity($entity, $request->all()));
    }

    public function show(Entity $entity, string $entity_value)
    {
        return new EntityValueResource($this->service->show($entity_value));
    }

    public function update(EntityValueRequest $request, Entity $entity, string $entity_value)
    {
        return new EntityValueResource($this->service->updateWithEntity($entity, $entity_value, $request->all()));
    }

    public function destroy(Entity $entity, string $entity_value)
    {
        $this->service->delete($entity_value);

        return response()->json();
    }
}
