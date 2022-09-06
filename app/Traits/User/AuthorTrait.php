<?php

namespace App\Traits\User;

use App\Models\Post;
use App\Models\Scopes\AuthorScope;

trait AuthorTrait
{
    protected static function booted()
    {
        if (request()->path() == 'api/post/my') {
            static::addGlobalScope(new AuthorScope());
        }
        if (request()->path() == 'api/post/search') {
            return Post::withoutGlobalScopes();
        }
    }
}
