<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;

class WebPostController extends Controller
{
    public function showAll()
    {
        $posts = Post::orderBy('created_at', 'DESC');
        return view('posts/all', ['posts' => $posts->paginate(6)]);
    }

    public function showOne(Post $post)
    {
        return view('posts/show', ['post' => $post]);
    }

    public function edit(Post $post)
    {
        return view('posts/edit', ['post' => $post]);
    }

    public function editSubmit($id, UpdatePostRequest $request)
    {
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->text = $request->input('text');
        $post->date = date("d.m.Y");
        $post->save();
        return redirect()->route('showOne', $post->id)->with('success', 'Сообщение изменено');
    }


    public function create()
    {
        return view('posts/create');
    }

    public function createSubmit(UpdatePostRequest $request)
    {
        $post = new Post();
        $post->title = $request->input('title');
        $post->text = $request->input('text');
        $post->date = date("d.m.Y");
        $post->user_id = auth()->user()->id;
        $post->save();
        return redirect()->route('showAll')->with('success', 'Сообщение добавлено');
    }

    public function delete($id)
    {
        Post::find($id)->delete();
        return redirect()->route('showAll')->with('success', 'Сообщение удалено');
    }
}
