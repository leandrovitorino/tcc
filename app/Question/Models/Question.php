<?php

namespace App\Question\Models;

use App\Option\Models\Option;
use App\Test\Models\Test;
use App\Test\Models\TestQuestion;
use App\Topic\Models\Topic;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'body', 'image', 'age', 'topic_id', 'deleted_at'
    ];

    public $timestamps = false;

    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class);
    }

    public function options(): HasMany
    {
        return $this->hasMany(Option::class);
    }

    public function tests(): HasMany
    {
        return $this->hasMany(TestQuestion::class);
    }
}
