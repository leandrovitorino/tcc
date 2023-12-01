<?php

namespace App\Test\Services;

use App\Test\Models\Test;

class DeleteQuestionService
{
    public function remove(Test $test): void
    {
        foreach ($test->questions as $question){
            $question->delete();
        }
    }
}
