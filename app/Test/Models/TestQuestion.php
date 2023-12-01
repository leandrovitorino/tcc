<?php

namespace App\Test\Models;

use App\Question\Models\Question;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TestQuestion extends Model
{
    protected $table = 'test_question';

    protected $fillable = ['test_id', 'question_id'];

    public $timestamps = true;

    public function test(): BelongsTo
    {
        return $this->belongsTo(Test::class);
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}
