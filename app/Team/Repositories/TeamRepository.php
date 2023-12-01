<?php

namespace App\Team\Repositories;

use App\Base\Repositories\BaseRepository;
use App\Team\Interfaces\TeamRepositoryInterface;
use App\Team\Models\Team;
use Illuminate\Pagination\LengthAwarePaginator;

class TeamRepository extends BaseRepository implements TeamRepositoryInterface
{
    protected string $model = Team::class;

    public function getTeams(array $filter = []): LengthAwarePaginator
    {
        $result = $this->model::query();

        if ($filter != []){
            $result
                ->where('code', 'LIKE', '%' . $filter['search'] . '%')
                ->orWhere('shift', 'LIKE', '%' . $filter['search'] . '%')
                ->orWhere('matter', 'LIKE', '%' . $filter['search'] . '%');
        }

        return $result->paginate(20);
    }
}
