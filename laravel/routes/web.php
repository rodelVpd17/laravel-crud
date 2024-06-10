<?php

use App\Models\Post;
use App\Http\Controllers\SignUp;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    $posts = [];

    if(auth()->check()){
        $posts = Post::all();
        $posts = auth()->user()->usersCoolPosts()->latest()->get();
    }

    return view('home', ['posts' => $posts]);
});

// User related routes
Route::post('/register', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/login', [UserController::class, 'login']);

// Blog post related routes
Route::post('/create-post', [PostController::class, 'createPost']);
Route::get('/edit-post/{post}', [PostController::class, 'showEditScreen']);
Route::post('/edit-post/{post}', [PostController::class, 'editPost']);