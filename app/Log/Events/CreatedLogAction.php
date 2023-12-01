<?php

namespace App\Log\Events;

use Illuminate\Foundation\Events\Dispatchable;

class CreatedLogAction
{
    use Dispatchable;

    private array $log;

    public function __construct(array $log)
    {
        $this->log = $log;
    }

    public function getData(): array
    {
         return $this->log;
    }

}
