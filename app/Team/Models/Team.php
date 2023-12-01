<?php

namespace App\Team\Models;

use App\Test\Models\Test;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model
{
    use SoftDeletes;

    protected $fillable = ['code', 'shift', 'matter', 'deleted_at'];

    public function tests(): HasMany
    {
        return $this->hasMany(Test::class);
    }
}
