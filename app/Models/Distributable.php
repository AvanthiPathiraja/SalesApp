<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distributable extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function issue_items()
    {
        return $this->morphedByMany(Post::class, 'taggable');
    }

    public function invoice_returns()
    {
        return $this->morphedByMany(Video::class, 'taggable');
    }
}
