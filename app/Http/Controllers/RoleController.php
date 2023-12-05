<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use App\Services\RoleService;

class RoleController extends Controller
{
    private RoleService $service;

    /**
     * @param RoleService $service
     */
    public function __construct(RoleService $service)
    {
        $this->service = $service;
    }


    public function index()
    {
        return RoleResource::collection($this->service->getAll());
    }

    public function store(RoleRequest $request)
    {
        return new RoleResource($this->service->create($request->all()));
    }

    public function show(Role $role)
    {
        return new RoleResource($this->service->show($role->id));
    }

    public function update(RoleRequest $request, Role $role)
    {
        return new RoleResource($this->service->update($role->id, $request->all()));
    }

    public function destroy(Role $role)
    {
        $this->service->delete($role->id);
        return response()->json();
    }
}
