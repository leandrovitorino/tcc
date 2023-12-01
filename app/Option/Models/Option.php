<?php

namespace App\Option\Models;

use App\Question\Models\Question;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Option extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'response', 'question_id', 'correct', 'deleted_at'
    ];

    public $timestamps = false;

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}
