<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\Meetings\IMeetingRepository;
use App\Repositories\Meetings\MeetingRepository;
use App\Repositories\Tasks\ITaskRepository;
use App\Repositories\Tasks\TaskRepository;


class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IMeetingRepository::class, MeetingRepository::class);
        $this->app->bind(ITaskRepository::class, TaskRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
