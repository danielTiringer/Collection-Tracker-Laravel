<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\CollectionElement;
use App\Models\CollectionEntity;
use App\Models\Source;
use App\Models\User;
use App\Policies\CollectionElementPolicy;
use App\Policies\CollectionEntityPolicy;
use App\Policies\SourcePolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        CollectionElement::class => CollectionElementPolicy::class,
        CollectionEntity::class => CollectionEntityPolicy::class,
        Source::class => SourcePolicy::class,
        User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
