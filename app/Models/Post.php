<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ["community_id", "user_id", "title", "post_text", "post_url", "post_image"];

    /**
     * @return HasMany
     */
    public function votes()
    {
        return $this->hasMany(PostVote::class);
    }

    /**
     * @return BelongsTo
     */
    public function community()
    {
        return $this->belongsTo(Community::class);
    }

    /**
     * @return HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
