<?php

namespace App\Log\Repositories;

use App\Base\Repositories\BaseRepository;
use App\Log\Interfaces\LogActionRepositoryInterface;
use App\Log\Models\Log;
use Illuminate\Pagination\LengthAwarePaginator;

class LogActionRepository extends BaseRepository implements LogActionRepositoryInterface
{
    protected string $model = Log::class;

    public function search(int $perPage, array $filters): LengthAwarePaginator
    {
        $result = $this->model::query();

        if (isset($filters['msg'])) {
            $result
                ->where('msg', 'LIKE', '%' . $filters['msg'] . '%');
        }

        $result->orderBy('created_at', 'desc');
        return $result->paginate($perPage);
    }
}
