<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserService $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }


    public function index()
    {
        return UserResource::collection($this->service->getAll());
    }

    public function store(Request $request)
    {
        return new UserResource($this->service->create($request->all()));
    }

    public function show(User $role)
    {
        return new UserResource($this->service->show($role->id));
    }

    public function update(Request $request, User $role)
    {
        return new UserResource($this->service->update($role->id, $request->all()));
    }

    public function destroy(User $role)
    {
        $this->service->delete($role->id);
        return response()->json();
    }
}
