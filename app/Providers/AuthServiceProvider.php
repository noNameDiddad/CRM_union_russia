<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\EntityField;
use App\Models\EntityValue;
use App\Policies\EntityMasterPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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
    }
}
