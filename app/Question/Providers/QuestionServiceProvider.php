<?php

namespace App\Question\Providers;

use App\Question\Interfaces\QuestionRepositoryInterface;
use App\Question\Repositories\QuestionRepository;
use Illuminate\Support\ServiceProvider;

class QuestionServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(QuestionRepositoryInterface::class, QuestionRepository::class);
    }

    public function boot()
    {
        //
    }
}
