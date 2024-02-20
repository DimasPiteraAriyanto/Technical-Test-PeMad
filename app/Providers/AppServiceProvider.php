<?php

namespace App\Providers;

use App\Models\Client;
use App\Models\Project;
use App\Models\JobType;
use App\Models\User;
use App\Repositories\ClientRepository;
use App\Repositories\JobTypeRepository;
use App\Repositories\ProjectRepository;
use App\Repositories\UserRepository;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
//use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepository::class, function ($app) {
            return new UserRepository(new User());
        });

        $this->app->bind(ClientRepository::class, function ($app) {
            return new ClientRepository(new Client());
        });

        $this->app->bind(JobTypeRepository::class, function ($app) {
            return new JobTypeRepository(new JobType());
        });

        $this->app->bind(ProjectRepository::class, function ($app) {
            return new ProjectRepository(new Project());
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
    }
}
