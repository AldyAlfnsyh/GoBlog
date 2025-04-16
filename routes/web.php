<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PostController;
use App\Models\Comment;
use App\Models\Reply;
use App\Models\ReportType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;



Route::get('/profile', [ProfileController::class, "index"])->middleware('auth');
Route::post('/profile', [ProfileController::class, "update"])->middleware('auth');

Route::get('/login', [LoginController::class, "index"])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, "authenticate"])->middleware('guest');
Route::post('/logout', [LoginController::class, "logout"])->middleware('auth');
Route::get('/register', [RegisterController::class, "index"])->middleware('guest');
Route::post('/register', [RegisterController::class, "store"])->middleware('guest');

Route::get('/', function () {
    $posts = Post::orderByDesc('created_at')->limit(3)->get();
    return view('home' ,
    [
        'header_title' => 'Home Page',
        'title'=>'Home',
        'posts' => $posts
    ]);
});

Route::get('/create-article/{post:slug}', [PostController::class, 'viewUpdate'])->middleware('auth');
Route::post('/create-article/{post:slug}',[PostController::class, "update"])->middleware('auth');

Route::post('/dashboard',[PostController::class, "delete"])->middleware('auth');
Route::get('/dashboard', function () {
    if (Gate::allows('access_dashboard_user')) {
        return redirect()->route('filament.admin.pages.dashboard');
    }
    $myposts = Post::latest();
    $myposts = $myposts->where('author_id',Auth::id());
    if(request('search')){
        $myposts->where('title','like','%'.request('search').'%')->orWhereHas('category', function ($query) {
            $query->where('name', 'like', '%' . request('search') . '%');
        });
    }
    $total_article = (clone $myposts)->count();
    
    // list table like dan posts, berdasarkan user login
    $posts_and_like_by_user_login_id = DB::table('likes')
    ->join('posts', 'likes.post_id','=','posts.id')
    ->join('users', 'posts.author_id','=','users.id')
    ->where('users.id','=',Auth::id())->get();
    $total_like = $posts_and_like_by_user_login_id->where('type','like')->count();
    $total_dislike = $posts_and_like_by_user_login_id->where('type','dislike')->count();
  
    
    $like_percentage = ($total_like + $total_dislike) > 0 ? round(100 *  $total_like / ($total_like + $total_dislike), 2) : 0;
    
    $myposts_paginate = $myposts->paginate(10);

    return view('dashboard' ,
    [
        'header_title' => 'Halo, '.Auth::user()->name.'!',
        'title'=>'Dashboard', 
        'myposts' => $myposts_paginate, 
        'total_article' => $total_article,
        'total_like' => $total_like,
        'total_dislike' => $total_dislike,
        'like_percentage' => $like_percentage
    ]);
})->name('dashboard')->middleware('auth');

Route::get('/create-article', function () {
    return view('create-article' ,
    [
        'header_title' => 'Create Article',
        'title'=>'Create Article']);
})->middleware('auth');
Route::post('/create-article', [PostController::class, "store"])->middleware('auth');

Route::get('/posts', function () {
    
    $posts = Post::withCount([
        'likes as like_count' => function ($query) {
            $query->where('type', 'like');
        },
        'likes as dislike_count' => function ($query) {
            $query->where('type', 'dislike');
        }
    ])->latest();

    if(request('search')){
        $posts->where('title','like','%'.request('search').'%')->orWhereHas('author', function ($query) {
            $query->where('name', 'like', '%' . request('search') . '%');
        })->orWhereHas('category', function ($query) {
            $query->where('name', 'like', '%' . request('search') . '%');
        });
    }
    $posts = $posts->paginate(10);
    return view('posts',
    [
        'header_title' => 'List Posts',
        'title'=>'Blog',
        'posts' => $posts,
    ]);
});
Route::post('/posts/{post:slug}/comment_report', [CommentController::class, 'comment_report'])->name('comment.report')->middleware('auth');
Route::post('/posts/{post:slug}/reply_report', [CommentController::class, 'reply_report'])->name('reply.report')->middleware('auth');
Route::post('/posts/{post:slug}/post_report', [CommentController::class, 'post_report'])->name('post.report')->middleware('auth');

Route::post('/posts/{post:slug}/reply_delete', [CommentController::class, 'reply_delete'])->name('reply.delete')->middleware('auth');
Route::post('/posts/{post:slug}/comment_delete', [CommentController::class, 'comment_delete'])->name('comment.delete')->middleware('auth');
Route::post('/posts/{post:slug}/reply_edit', [CommentController::class, 'reply_update'])->name('reply.update')->middleware('auth');
Route::post('/posts/{post:slug}/comment_edit', [CommentController::class, 'comment_update'])->name('comment.update')->middleware('auth');
Route::post('/posts/{post:slug}/comment', [CommentController::class, 'storeComment'])->name('post.comment')->middleware('auth');
Route::post('/posts/{post:slug}/replyComment', [CommentController::class, 'storeReplyComment'])->name('post.comment.reply')->middleware('auth');
Route::post('/posts/{post:slug}/likeOrDislike', [LikeController::class, 'toggleLikeDislike'])->name('postLikeOrDislike')->middleware('auth');

Route::get('/posts/{post:slug}', function(Post $post){
    $reports = ReportType::all();
    $post = Post::withCount([
        'likes as like_count' => function ($query) {
            $query->where('type', 'like');
        },
        'likes as dislike_count' => function ($query) {
            $query->where('type', 'dislike');
        }
    ])->find($post->id);
    
    $comments = Comment::where('post_id',$post['id'])->orderByDesc('created_at')->get();

    $replies = Reply::where('post_id',$post['id'])->get();

    $count_discussion = $comments->count();
    return view('post', 
    [
        'title' => 'Post',
        'post' => $post, 
        'header_title' => 'Post', 
        'comments' => $comments, 
        'replies' => $replies,
        'count_discussion'=>$count_discussion,
        'reports' => $reports
    ]);
});

Route::get('/authors/{user:slug}', function(User $user){
    return view('posts', 
    [
        'title' => 'Authors', 
        'posts' => $user->posts()->with('category','author')->paginate(10), 
        'header_title' => 'Article by '. $user['name']]);
});

Route::get('/categories/{category:slug}', function(Category $category){
    return view('posts', 
    [
        'title' => 'Categories', 
        'posts' => $category->posts()->with('category','author')->paginate(10), 
        'header_title' => 'Posts with Category '. $category['name']]);
});

Route::get('/about', function () {
    return view('about', 
    [
        'header_title' => 'About Us','title'=>'About']);
});


Route::get('/contact', function () {
    return view('contact' ,
    [
        'header_title' => 'Contact Us',
        'title'=>'Contact'
    ]);
});