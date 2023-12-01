<?php

namespace App\Base\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{
    public function save(Model $model): Model;
    public function all(): Collection;
    public function find(int $id): Model;
    public function delete(int $id);
    public function update(int $id, array $data);
    public function updateOrCreate(array $keys, array $data):void;
}
