<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\EntityField;
use App\Models\EntityValue;
use App\Policies\EntityMasterPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
        EntityValue::class => EntityMasterPolicy::class,
        EntityField::class => EntityMasterPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // $this->registerPolicies();
        Gate::define('view', [EntityMasterPolicy::class, 'view']);
        Gate::define('viewAny', [EntityMasterPolicy::class, 'viewAny']);
        Gate::define('create', [EntityMasterPolicy::class, 'create']);
        Gate::define('update', [EntityMasterPolicy::class, 'update']);
        Gate::define('delete', [EntityMasterPolicy::class, 'delete']);
    }
}
