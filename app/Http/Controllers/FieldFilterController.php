<?php

namespace App\Http\Controllers;

use App\Http\Requests\EntityRequest;
use App\Http\Resources\EntityResource;
use App\Http\Resources\FieldFilterResource;
use App\Services\EntityService;
use App\Services\FieldFilterService;
use Illuminate\Http\Request;

class FieldFilterController extends Controller
{
    private FieldFilterService $service;

    public function __construct()
    {
        $this->service = new FieldFilterService();
    }

    public function show(string $entity_id)
    {
        return new FieldFilterResource($this->service->show($entity_id));
    }

    public function update(Request $request, string $entity_id)
    {
        return new FieldFilterResource($this->service->updateByEntityId($entity_id, $request->all()));
    }
}
