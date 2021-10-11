<?php

namespace App\Providers;

use AppRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Repository\Eloquent\AppRepository;
use App\Repository\Eloquent\BaseRepository;
use App\Repository\Eloquent\UserRepository;
use App\Repository\UserRepositoryInterface;
use App\Repository\DeviceRepositoryInterface;
use App\Repository\Eloquent\DeviceRepository;
use App\Repository\EloquentRepositoryInterface;
use App\Repository\Eloquent\SubscriptionRepository;
use App\Repository\SubscriptionRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(DeviceRepositoryInterface::class, DeviceRepository::class);
        $this->app->bind(AppRepositoryInterface::class, AppRepository::class);
        $this->app->bind(SubscriptionRepositoryInterface::class, SubscriptionRepository::class);
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
