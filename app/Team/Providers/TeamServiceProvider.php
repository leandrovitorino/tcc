<?php

namespace App\Team\Providers;

use App\Team\Interfaces\TeamRepositoryInterface;
use App\Team\Repositories\TeamRepository;
use Illuminate\Support\ServiceProvider;

class TeamServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(TeamRepositoryInterface::class, TeamRepository::class);
    }

    public function boot()
    {
        //
    }
}
