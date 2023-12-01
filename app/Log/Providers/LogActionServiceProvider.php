<?php

namespace App\Log\Providers;

use App\Log\Interfaces\LogActionRepositoryInterface;
use App\Log\Repositories\LogActionRepository;
use Illuminate\Support\ServiceProvider;

class LogActionServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(LogActionRepositoryInterface::class, LogActionRepository::class);
    }

    public function boot()
    {
        //
    }
}
