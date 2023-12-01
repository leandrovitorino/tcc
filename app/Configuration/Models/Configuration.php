<?php

declare(strict_types=1);

namespace App\Configuration\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    use HasFactory;

    protected $fillable = ['path', 'value'];
    public $timestamps = false;
}
