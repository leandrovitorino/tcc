<?php

namespace App\Subject\Repositories;

use App\Base\Repositories\BaseRepository;
use App\Subject\Interfaces\SubjectRepositoryInterface;
use App\Subject\Models\Subject;
use Illuminate\Pagination\LengthAwarePaginator;

class SubjectRepository extends BaseRepository implements SubjectRepositoryInterface
{
    protected string $model = Subject::class;

    public function search(array $filters): LengthAwarePaginator
    {
        $resp = $this->model::query();

        if (isset($filters['search'])){
            $resp->where('name', 'LIKE', '%' . $filters['search'] . '%');
        }

        return $resp
            ->orderBy('name', 'asc')
            ->paginate(20);
    }
}
