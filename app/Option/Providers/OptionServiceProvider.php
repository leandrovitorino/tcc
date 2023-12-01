<?php

namespace App\Option\Providers;

use App\Option\Interfaces\OptionRepositoryInterface;
use App\Option\Repositories\OptionRepository;
use Illuminate\Support\ServiceProvider;

class OptionServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(OptionRepositoryInterface::class, OptionRepository::class);
    }

    public function boot()
    {
        //
    }
}
