<?php

namespace App\Test\Repositories;

use App\Base\Repositories\BaseRepository;
use App\Test\Interfaces\TestRepositoryInterface;
use App\Test\Models\Test;
use Illuminate\Pagination\LengthAwarePaginator;

class TestRepository extends BaseRepository implements TestRepositoryInterface
{
    protected string $model = Test::class;

    public function getTests(array $filter = []): LengthAwarePaginator
    {
        $result = $this->model::query();

        if ($filter != []){
            $result->where('code', 'LIKE', '%' . $filter['search'] . '%');
        }

        return $result->paginate(20);
    }
}
