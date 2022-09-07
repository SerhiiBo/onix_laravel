<?php

namespace App\Traits\User;

use App\Models\Post;
use App\Models\Scopes\AuthorScope;
use Illuminate\Support\Facades\Route;

trait AuthorTrait
{
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new AuthorScope());
    }
}
