<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Posts;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        if (!$request->query()) {
            return Posts::all('title', 'text', 'date');
        } elseif ($request->query('keywords')) {
            return $this->findByKeywords($request);
        }  else return 'Wrong query';
    }

    public function findByKeywords(Request $request)
    {
        $search_words = "%".$request->query('keywords')."%";
        $post = Posts::where('title','ilike', $search_words)
            ->orWhere('text','ilike', $search_words)
            ->paginate(5)
            ->withQueryString();

        return PostResource::collection($post);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return PostResource
     */
    public function store(UpdatePostRequest $request)
    {
        $created_post = Posts::create($request->validated());

        return new PostResource( $created_post);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Posts $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Posts::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Posts  $post
     * @return Posts
     */
    public function update(UpdatePostRequest $request, Posts $post)
    {
        $post->update($request->validated());

        return $post;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Posts  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Posts $post)
    {
       $post->delete();

       return response(null,Response::HTTP_NO_CONTENT);
    }
}
