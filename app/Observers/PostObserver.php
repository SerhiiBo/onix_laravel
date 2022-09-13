<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Facades\DB;

class PostObserver
{
    /**
     * Handle the Post "created" event.
     *
     * @param \App\Models\Post $post
     * @return void
     */
    public function created(Post $post)
    {
        DB::table('users')
            ->where('id', $post->user_id)
            ->increment('total_posts');
    }

    /**
     * Handle the Post "deleted" event.
     *
     * @param \App\Models\Post $post
     * @return void
     */
    public function deleted(Post $post)
    {
        DB::table('users')
            ->where('id', $post->user_id)
            ->decrement('total_posts');
    }
}
