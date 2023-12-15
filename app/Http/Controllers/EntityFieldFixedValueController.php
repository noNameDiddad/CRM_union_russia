<?php

namespace App\Http\Controllers;

use App\Http\Requests\EntityFieldFixedValuesRequest;

use App\Http\Resources\EntityFieldFixedValueResource;
use App\Models\EntityField;
use App\Models\EntityFieldFixedValue;
use App\Services\EntityFieldFixedValueService as EntityFieldService;



class EntityFieldFixedValueController extends Controller
{
    private EntityFieldService $service;

    public function __construct()
    {
        $this->service = new EntityFieldService();
        $this->authorizeResource(EntityFieldFixedValue::class);
    }

    public function index(EntityField $entity_field)
    {
        return EntityFieldFixedValueResource::collection($this->service->allByEntityFields($entity_field));
    }

    public function show(EntityField $entity_field, string $entity_field_fixed_value) {
        return new EntityFieldFixedValueResource($this->service->show($entity_field_fixed_value));
    }

    public function store(EntityFieldFixedValuesRequest $request, EntityField $entity_field) {
        return new EntityFieldFixedValueResource($this->service->createWithEntityField($entity_field, $request->all()));
    }

    public function update(EntityFieldFixedValuesRequest $request, EntityField $entity_field, string $entity_field_fixed_value) {
        return new EntityFieldFixedValueResource($this->service->updateWithEntityField($entity_field, $entity_field_fixed_value, $request->all()));
    }

    public function destroy(EntityField $entity_field, string $entity_field_fixed_value) {
        $this->service->delete($entity_field_fixed_value);

        return response()->json();
    }
}

