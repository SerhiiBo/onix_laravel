<?php

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


Route::get('/webposts', [WebPostController::class, 'showAll'])->name('showAllPosts');

Route::get('/webposts/addNew', [WebPostController::class, 'createPost'])->middleware(['auth'])->name('createPostForm');;
Route::get('/webposts/{id}', [WebPostController::class, 'showOne'])->name('showOnePost');

Route::get('/webposts/{id}/edit', [WebPostController::class, 'editPost'])->middleware(['auth'])->name('postEdit');
Route::get('/webposts/{id}/delete', [WebPostController::class, 'deletePost'])->middleware(['auth'])->name('postDelete');

Route::post('/webposts/{id}/edit', [WebPostController::class, 'editPostSubmit'])->middleware(['auth'])->name('postEditSubmit');
Route::post('/webposts/addNew/success', [WebPostController::class, 'createPostSubmit'])->middleware(['auth'])->name('addNewPost');


Route::get('/users', function (){
    return dd(\App\Models\User::all());
})->name('showAllUsers');





require __DIR__.'/auth.php';
