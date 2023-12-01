<?php

namespace App\Test\Providers;

use App\Test\Interfaces\TestRepositoryInterface;
use App\Test\Repositories\TestRepository;
use Illuminate\Support\ServiceProvider;

class TestServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(TestRepositoryInterface::class, TestRepository::class);
    }

    public function boot()
    {
        //
    }
}
