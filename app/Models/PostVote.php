<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostVote extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'post_id', 'vote'];

    public function vote()
    {
        return $this->belongsTo(Post::class);
    }
}
