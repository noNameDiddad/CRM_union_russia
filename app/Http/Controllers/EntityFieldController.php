<?php

namespace App\Http\Controllers;

use App\Http\Requests\EntityFieldRequest;

use App\Http\Resources\EntityFieldResource;
use App\Models\Contact;
use App\Models\Entity;
use App\Models\EntityField;
use App\Services\EntityFieldsService as EntityFieldService;

class EntityFieldController extends Controller
{
    private EntityFieldService $service;

    public function __construct()
    {
        $this->service = new EntityFieldService();
        $this->authorizeResource(EntityField::class);
    }

    public function index(Entity $entity)
    {
        return EntityFieldResource::collection($this->service->getAllByEntity($entity));
    }

    public function show(Entity $entity, string $entity_field) {
        return new EntityFieldResource($this->service->show($entity_field));
    }

    public function store(EntityFieldRequest $request, Entity $entity) {
         return new EntityFieldResource($this->service->createWithEntity($entity, $request->all()));
    }

    public function update(EntityFieldRequest $request, Entity $entity, string $entity_field) {
        return new EntityFieldResource($this->service->updateWithEntity($entity, $entity_field, $request->all()));
    }

    public function destroy(Entity $entity, string $entity_field) {
        $this->service->delete($entity_field);

        return response()->json();
    }
}
