<?php

namespace App\Question\Repositories;

use App\Base\Repositories\BaseRepository;
use App\Question\Interfaces\QuestionRepositoryInterface;
use App\Question\Models\Question;
use Illuminate\Pagination\LengthAwarePaginator;

class QuestionRepository extends BaseRepository implements QuestionRepositoryInterface
{
    protected string $model = Question::class;

    public function getQuestionsOrderByTopicName(): LengthAwarePaginator
    {
        return $this->model::query()
            ->select('questions.*')
            ->join('topics', 'topics.id', 'questions.topic_id')
            ->orderBy('topics.name', 'asc')
            ->paginate(20);
    }
}
