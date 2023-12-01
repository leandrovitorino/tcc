<?php

namespace App\Topic\Repositories;

use App\Base\Repositories\BaseRepository;
use App\Topic\Interfaces\TopicRepositoryInterface;
use App\Topic\Models\Topic;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class TopicRepository extends BaseRepository implements TopicRepositoryInterface
{
    protected string $model = Topic::class;

    public function getTopicsBySubjectId($subjectId): Collection
    {
        return $this->model::query()
            ->where('subject_id', $subjectId)
            ->get();
    }

    public function getTopicsOrderBySubjectName(): LengthAwarePaginator
    {
        return $this->model::query()
            ->select('topics.*')
            ->join('subjects', 'subjects.id', 'topics.subject_id')
            ->orderBy('subjects.name', 'asc')
            ->paginate(20);
    }

    public function getTopicsOrderByName(): Collection
    {
        return $this->model::query()
            ->orderBy('name', 'asc')
            ->get();
    }
}
