<?php

namespace App\User\Repositories;

use App\Base\Repositories\BaseRepository;
use App\Role\Models\Role;
use App\User\Interfaces\UserRepositoryInterface;
use App\User\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    protected string $model = User::class;

    public function getUsers(): LengthAwarePaginator
    {
        return $this->model::query()
            ->orderBy('name')
            ->paginate(20);
    }

    public function getNameRole(object $users): object
    {
        for ($i = 0; $i < $users->count(); $i++) {
            $users[$i]->role_name = Role::find($users[$i]->role_id)->name;
        }

        return $users;
    }

    public function getUserByName(String $name)
    {
        return User::query()
            ->where('name', 'LIKE', '%'.$name.'%')
            ->first();
    }
}
