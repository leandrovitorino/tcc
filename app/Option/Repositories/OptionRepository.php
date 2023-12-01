<?php

namespace App\Option\Repositories;

use App\Base\Repositories\BaseRepository;
use App\Option\Interfaces\OptionRepositoryInterface;
use App\Option\Models\Option;

class OptionRepository extends BaseRepository implements OptionRepositoryInterface
{
    protected string $model = Option::class;
}
