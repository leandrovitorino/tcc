<?php

namespace App\Team\Interfaces;

use App\Base\Interfaces\BaseRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

interface TeamRepositoryInterface extends BaseRepositoryInterface
{
    public function getTeams(array $filter = []): LengthAwarePaginator;
}
