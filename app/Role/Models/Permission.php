<?php

namespace App\Role\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
{
    protected $fillable = ['name'];
    public $timestamps = false;

    public function role(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }
}
