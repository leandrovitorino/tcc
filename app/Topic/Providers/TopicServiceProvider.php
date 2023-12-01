<?php

namespace App\Topic\Providers;

use App\Topic\Interfaces\TopicRepositoryInterface;
use App\Topic\Repositories\TopicRepository;
use Illuminate\Support\ServiceProvider;

class TopicServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(TopicRepositoryInterface::class, TopicRepository::class);
    }

    public function boot()
    {
        //
    }
}
