<?php

namespace App\Log\Services;

use App\Log\Models\Log;
use Illuminate\Support\Facades\Auth;

class CreateLogAction
{
    public function execute(array $log): void
    {
        if (Auth::check()) {
            $user = Auth::user();
            Log::create([
                'user_id' => $user->id,
                'msg' => $user->name . ' ' . $log['event'] . $log['title'] . $log['info'] . ' às ' . date('H:i:s d/m/Y')
            ]);
        }
    }
}
