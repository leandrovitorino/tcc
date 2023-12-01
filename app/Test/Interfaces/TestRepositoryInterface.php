<?php

namespace App\Test\Interfaces;

use App\Base\Interfaces\BaseRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

interface TestRepositoryInterface extends BaseRepositoryInterface
{
    public function getTests(array $filter = []): LengthAwarePaginator;
}
