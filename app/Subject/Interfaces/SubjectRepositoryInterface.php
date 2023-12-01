<?php

namespace App\Subject\Interfaces;

use App\Base\Interfaces\BaseRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

interface SubjectRepositoryInterface extends BaseRepositoryInterface
{
    public function search(array $filters): LengthAwarePaginator;
}
