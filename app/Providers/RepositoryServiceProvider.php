<?php

namespace App\Providers;

use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\DepartmentRepositoryInterface;
use App\Interfaces\EventActivityRepositoryInterface;
use App\Interfaces\EventRepositoryInterface;
use App\Interfaces\EventTeamMemberRepositoryInterface;
use App\Interfaces\UserProfileRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Repositories\CategoryRepository;
use App\Repositories\DepartmentRepository;
use App\Repositories\EventActivityRepository;
use App\Repositories\EventRepository;
use App\Repositories\EventTeamMemberRepository;
use App\Repositories\userProfileRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(DepartmentRepositoryInterface::class, DepartmentRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(EventRepositoryInterface::class, EventRepository::class);
        $this->app->bind(EventTeamMemberRepositoryInterface::class, EventTeamMemberRepository::class);
        $this->app->bind(EventActivityRepositoryInterface::class, EventActivityRepository::class);
        $this->app->bind(UserProfileRepositoryInterface::class, userProfileRepository::class);

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
