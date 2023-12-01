<?php

namespace App\Subject\Observers;

use App\Log\Events\CreatedLogAction;
use App\Subject\Models\Subject;

class SubjectObserver
{
    public function created(Subject $subject): void
    {
        $log = [
            'event' => 'criou o ',
            'title' => 'Assunto ',
            'info' => $subject->name
        ];

        CreatedLogAction::dispatch($log);
    }

    public function updated(Subject $subject): void
    {
        $log = [
            'event' => 'editou o ',
            'title' => 'Assunto ',
            'info' => $subject->name
        ];

        CreatedLogAction::dispatch($log);
    }
}
