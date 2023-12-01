<?php

namespace App\Base\Repositories;

use App\Base\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseRepositoryInterface
{
    protected string $model;

    public function save(Model $model): Model
    {
        $model->save();
        return $model;
    }

    public function all(): Collection
    {
        return $this->model::all();
    }

    public function find(int $id): Model
    {
        return $this->model::findOrFail($id);
    }

    public function delete(int $id)
    {
        $model = $this->find($id);
        $model->delete();
    }

    public function update(int $id, array $data)
    {
        $model = $this->find($id);
        $model->update($data);
    }

    public function updateOrCreate(array $keys , array $data): void
    {
        $this->model::updateOrCreate($keys, $data);
    }
}
