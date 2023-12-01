<?php

namespace App\Subject\Providers;

use App\Subject\Interfaces\SubjectRepositoryInterface;
use App\Subject\Repositories\SubjectRepository;
use Illuminate\Support\ServiceProvider;

class SubjectServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(SubjectRepositoryInterface::class, SubjectRepository::class);
    }

    public function boot()
    {
        //
    }
}
