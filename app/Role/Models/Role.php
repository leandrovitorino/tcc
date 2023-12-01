<?php

namespace App\Role\Models;

use App\User\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'deleted_at'];
    public $timestamps = false;

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class);
    }

    public function user(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function cleanPermissions()
    {
        $this->permissions()->detach();
    }

    public function allowTo($permission)
    {
        $this->permissions()->save($permission);
    }
}
