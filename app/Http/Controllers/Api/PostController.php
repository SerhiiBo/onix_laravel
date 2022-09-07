<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Scopes\AuthorScope;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $query = Post::title($request->get('title'))
            ->body($request->get('body'))
            ->tags($request->get('tags'));
        return PostResource::collection($query->paginate(10));
    }

    public function search(Request $request)
    {
        $query = Post::withoutGlobalScope(AuthorScope::class)
            ->title($request->get('title'))
            ->body($request->get('body'))
            ->tags($request->get('tags'));
        return PostResource::collection($query->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return PostResource
     */
    public function store(UpdatePostRequest $request): PostResource
    {
        $createdPost = Post::create($request->validated());
        if ($request->has('tags')) {
            $attachableTags = [];
            foreach (explode(",", $request->tags) as $tag) {
                $attachableTags[] = Tag::firstOrCreate(['name' => $tag])->id;
            }
            $createdPost->tags()->sync($attachableTags);
        }
        return new PostResource($createdPost);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Post $post
     * @return PostResource
     */
    public function show(Post $post): PostResource
    {
        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post
     * @return Post
     */
    public function update(UpdatePostRequest $request, Post $post): PostResource
    {
        $post->update($request->validated());
        if ($request->has('tags')) {
            $updatableTags = [];
            foreach (explode(",", $request->tags) as $tag) {
                $updatableTags[] = Tag::firstOrCreate(['name' => $tag])->id;
            }
            $post->tags()->sync($updatableTags);
        }
        return new PostResource($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
