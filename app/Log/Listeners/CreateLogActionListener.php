<?php

namespace App\Log\Listeners;

use App\Log\Events\CreatedLogAction as LogEvent;
use App\Log\Services\CreateLogAction as LogService;

class CreateLogActionListener
{
    private LogService $createLog;

    public function __construct(LogService $createLog)
    {
        $this->createLog = $createLog;
    }

    public function handle(LogEvent $event)
    {
        $this->createLog->execute($event->getData());
    }
}
