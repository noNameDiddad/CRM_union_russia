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

    public function view(User $user, EntityValue $entityValue): bool
    {
        // anyone can
        return true;
    }

    public function create(User $user): bool
    {
        return in_array('create', ...$this->permission);
    }

    public function update(User $user, EntityValue $entityValue): bool
    {
        return in_array('update', ...$this->permission);
    }

    public function delete(User $user, EntityValue $entityValue): bool
    {
        return in_array('delete', ...$this->permission);
    }

    public function after() {
        dd('emw');
    }

    // public function restore(User $user, EntityValue $entityValue): bool
    // {
    //     return true;
    // }

    // public function forceDelete(User $user, EntityValue $entityValue): bool
    // {
    //     return true;
    // }
}
