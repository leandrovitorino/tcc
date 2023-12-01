<?php

namespace App\Log\Interfaces;

use App\Base\Interfaces\BaseRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

interface LogActionRepositoryInterface extends BaseRepositoryInterface
{
    public function search(int $perPage, array $filters): LengthAwarePaginator;
}
