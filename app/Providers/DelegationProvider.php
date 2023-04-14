<?php

namespace App\Providers;

use Domain\Repository\DelegationRepositoryInterface;
use Domain\Repository\CountryRepositoryInterface;
use Domain\Repository\WorkerRepositoryInterface;
use App\Repositories\DelegationRepository;
use App\Repositories\CountryRepository;
use App\Repositories\WorkerRepository;

use Illuminate\Support\ServiceProvider;

class DelegationProvider extends ServiceProvider
{
    public $bindings = [
        WorkerRepositoryInterface::class => WorkerRepository::class,
        CountryRepositoryInterface::class => CountryRepository::class,
        DelegationRepositoryInterface::class => DelegationRepository::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
