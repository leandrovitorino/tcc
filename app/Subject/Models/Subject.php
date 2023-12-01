<?php

namespace App\Subject\Models;

use App\Topic\Models\Topic;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subject extends Model
{
    protected $fillable = ['name'];

    public $timestamps = false;

    public function topics(): HasMany
    {
        return $this->hasMany(Topic::class);
    }
}
