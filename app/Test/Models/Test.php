<?php

namespace App\Test\Models;

use App\Team\Models\Team;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Test extends Model
{
    use SoftDeletes;

    protected $fillable = ['code', 'team_id'];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function questions(): HasMany
    {
        return $this->hasMany(TestQuestion::class);
    }
}
