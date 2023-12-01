<?php

namespace App\User\Observers;

use App\Log\Events\CreatedLogAction;
use App\User\Models\User;

class UserObserver
{
    public function created(User $new_user): void
    {
        $log = [
            'event' => 'criou o ',
            'title' => 'Usuário ',
            'info' => $new_user->name
        ];

        CreatedLogAction::dispatch($log);
    }

    public function updated(User $user): void
    {
        $log = [
            'event' => 'alterou o ',
            'title' => 'Usuário ',
            'info' => $user->name
        ];

        CreatedLogAction::dispatch($log);
    }

    public function deleted(User $user): void
    {
        $log = [
            'event' => 'deletou o ',
            'title' => 'Usuário ',
            'info' => $user->name
        ];

        CreatedLogAction::dispatch($log);
    }
}
