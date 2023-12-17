<?php

namespace App\Http\Controllers;

use App\Http\Requests\EntityRequest;
use App\Http\Resources\EntityResource;
use App\Services\EntityService;
use Illuminate\Http\Request;

class EntityController extends Controller
{
    private EntityService $service;

    public function __construct()
    {
        $this->service = new EntityService();
    }

    public function index(Request $request)
    {
        if ($request->input('withAll')) {
            return EntityResource::collection($this->service->getAll());
        }
        return EntityResource::collection($this->service->getFiltered());
    }

    public function store(EntityRequest $request)
    {
          return new EntityResource($this->service->create($request->all()));
    }

    public function show(string $entity_value)
    {
        return new EntityResource($this->service->show($entity_value));
    }

    public function update(EntityRequest $request, string $entity)
    {
        return new EntityResource($this->service->update($entity, $request->all()));
    }

    public function destroy(string $entity)
    {
        $this->service->delete($entity);

        return response()->json();
    }
}
