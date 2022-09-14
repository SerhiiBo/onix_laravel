<?php

namespace App\Models;

use App\Traits\User\AuthorTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Illuminate\Database\Eloquent\Relations\MorphToMany;

class Post extends Model
{
    use HasFactory;
    use AuthorTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'text',
    ];

    public function scopeTitle(Builder $query, $title)
    {
        return $query->where('title', 'ILIKE', "%$title%");
    }

    public function scopeBody($query, $body)
    {
        return $query->where('text', 'ILIKE', "%$body%");
    }

    public function scopeTags($query, $tags)
    {
        return $query->whereHas('tags', function ($query) use ($tags) {
            $query->whereName($tags);
        })->with('tags');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable', 'post_tags')->withTimestamps();
    }
}
