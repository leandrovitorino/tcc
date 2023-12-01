<?php

namespace App\Topic\Interfaces;

use App\Base\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface TopicRepositoryInterface extends BaseRepositoryInterface
{
    public function getTopicsBySubjectId($subjectId): Collection;
    public function getTopicsOrderBySubjectName(): LengthAwarePaginator;
    public function getTopicsOrderByName(): Collection;
}
