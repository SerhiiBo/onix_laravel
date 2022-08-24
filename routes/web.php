<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\WebPostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/profile', function () {
    return view('profile');
})->middleware('auth');

//Route::get('/post/{post}', function (Post $post) {
//    return dd($post->title);
//});

Route::get('/posts', [WebPostController::class, 'showAll'])->name('showAll');

Route::get('/posts/create', [WebPostController::class, 'create'])->middleware(['auth'])->name('create_post');
Route::post('/posts/create', [WebPostController::class, 'createSubmit'])->middleware(['auth'])->name('create_post');

Route::get('/posts/{post}/edit', [WebPostController::class, 'edit'])->middleware(['auth'])->name('edit_post');
Route::post('/posts/{post}/edit', [WebPostController::class, 'editSubmit'])->middleware(['auth'])->name('edit_post');


Route::get('/posts/{post}', [WebPostController::class, 'showOne'])->name('showOne');

Route::get('/posts/{post}/delete', [WebPostController::class, 'delete'])->middleware(['auth'])->name('delete');


Route::get('/users', function () {
    return dd(\App\Models\User::all());
})->name('showAllUsers');


require __DIR__ . '/auth.php';
