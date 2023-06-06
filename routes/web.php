<?php /** @noinspection ALL */

use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\SessionsController;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Services\Newsletter;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;


Route::get('/', [PostController::class, 'index'])->name('home');

Route::get('posts/{post:slug}', [PostController::class, 'show']);
Route::post('posts/{post:slug}/comments', [PostCommentsController::class, 'store']);

Route::post('newsletter', NewsletterController::class);

Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('login', [SessionsController::class, 'create'])->middleware('guest');
Route::post('login', [SessionsController::class, 'store'])->middleware('guest');

Route::post('logout', [SessionsController::class, 'destroy'])->middleware('auth');


Route::middleware('can:admin')->group(function () {
    Route::get('/admin/posts', [AdminPostController::class, 'index']);
    Route::get('/admin/posts/{post}/edit', [AdminPostController::class, 'edit']);
    Route::get('/admin/posts/create/', [AdminPostController::class, 'create']);
    Route::post('/admin/posts', [AdminPostController::class, 'store']);
    Route::patch('/admin/posts/{post}', [AdminPostController::class, 'update']);
    Route::delete('/admin/posts/{post}', [AdminPostController::class, 'destory']);
});

