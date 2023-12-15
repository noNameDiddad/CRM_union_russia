<?php

namespace App\Policies;

use App\Models\EntityValue;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EntityMasterPolicy
{
    use HandlesAuthorization;

    public $permission;

    public function __construct()
    {
        $target = request()->route()->parameter('entity');
        $this->permission = auth()->user()->canDo($target->hash)->toArray();
    }

    public function viewAny(User $user): bool
    {
        // anyone can
        return true;
    }

    public function view(User $user): bool
    {
        // anyone can
        return in_array('view', ...$this->permission);
    }

    public function create(User $user): bool
    {
        return in_array('create', ...$this->permission);
    }

    public function update(User $user): bool
    {
        return in_array('update', ...$this->permission);
    }

    public function delete(User $user): bool
    {
        return in_array('delete', ...$this->permission);
    }

}
