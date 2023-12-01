<?php

namespace App\Base\Providers;

use App\Log\Events\CreatedLogAction;
use App\Log\Listeners\CreateLogActionListener;
use App\Subject\Models\Subject;
use App\Subject\Observers\SubjectObserver;
use App\User\Models\User;
use App\User\Observers\UserObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        CreatedLogAction::class => [
            CreateLogActionListener::class
        ]
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        User::observe(UserObserver::class);
        Subject::observe(SubjectObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
