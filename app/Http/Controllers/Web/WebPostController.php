<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Posts;

class WebPostController extends Controller
{
    public function showAll()
    {
        $posts = Posts::orderby('date','DESC');
        return view('posts/all-posts',['posts' => $posts->paginate(6)]);
    }

    public function showOne($id)
    {
        return view('posts/show-one-post', ['post' => Posts::find($id)]);
    }

    public function editPost($id)
    {

        return view('posts/edit-post', ['post' => Posts::find($id)]);
    }

    public function editPostSubmit($id, UpdatePostRequest $request)
    {
        $post = Posts::find($id);
        $post->title = $request->input('title');
        $post->text = $request->input('text');
        $post->date = date("d.m.Y");
        $post->save();

        return redirect()->route('showOnePost', $post->id)->with('success','Сообщение изменено');
    }


    public function createPost()
    {
        return view('posts/addNew-post');
    }

    public function createPostSubmit(UpdatePostRequest $request)
    {
        $post = new Posts();
        $post->title = $request->input('title');
        $post->text = $request->input('text');
        $post->date = date("d.m.Y");
        $post->user_id = auth()->user()->id;
        $post->save();

        return redirect()->route('showAllPosts')->with('success','Сообщение добавлено');
    }

     public function deletePost($id) {
        Posts::find($id)->delete();
        return redirect()->route('showAllPosts')->with('success','Сообщение удалено');
     }
}
