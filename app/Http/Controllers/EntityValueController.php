<?php

namespace App\Http\Controllers;

use App\Http\Resources\EntityValue\EntityValueResource;
use App\Models\EntityValue;


class EntityValueController extends Controller
{
    public function index() {
        $entityValue = EntityValue::all();
        return EntityValueResource::collection($entityValue);
    }
    public function show() {
        return 'show';
    }
    public function create() {
        return 'create';
    }
    public function store() {
        return 'store';
    }
    public function edit() {
        return 'edit';
    }
    public function update() {
        return 'update';
    }
    public function destroy() {
        return 'destroy';
    }
}
