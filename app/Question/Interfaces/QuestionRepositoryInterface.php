<?php

namespace App\Question\Interfaces;

use App\Base\Interfaces\BaseRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

interface QuestionRepositoryInterface extends BaseRepositoryInterface
{
    public function getQuestionsOrderByTopicName(): LengthAwarePaginator;
}
