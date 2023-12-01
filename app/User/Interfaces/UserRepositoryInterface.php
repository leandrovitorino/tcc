<?php

namespace App\User\Interfaces;

use App\Base\Interfaces\BaseRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    public function getUsers(): LengthAwarePaginator;
    public function getNameRole(object $user): object;
    public function getUserByName(String $name);
}
