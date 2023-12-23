<?php

use App\Http\Controllers\Admin\Blog\AuthorController;
use App\Http\Controllers\Admin\Blog\PostController;
use App\Http\Controllers\Admin\Shop\CustomerController;
use App\Http\Controllers\Admin\Shop\OrderController;
use App\Http\Controllers\Admin\Shop\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('DashboardDark');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 商店 shop
    Route::prefix('shop')->name('shop.')->group(function () {
        // 产品 products
        Route::resource('products', ProductController::class)->only('index', 'edit', 'update');

        // 订单 orders
        Route::resource('orders', OrderController::class)->only('index', 'edit', 'update');

        // 产品分类 categories
        Route::resource('categories', \App\Http\Controllers\Admin\Shop\CategoryController::class)->only('index', 'edit', 'update');

        // 顾客 customers
        Route::resource('customers', CustomerController::class)->only('index', 'edit', 'update');
    });

    // 博客 blog
    Route::prefix('blog')->name('blog.')->group(function () {
        // 帖子 posts
        Route::resource('posts', PostController::class)->only('index', 'edit', 'update');

        // 评论 comments
        Route::resource('comments', \App\Http\Controllers\Admin\Blog\CommentController::class)->only('index', 'edit', 'update');

        // 帖子分类 categories
        Route::resource('categories', \App\Http\Controllers\Admin\Blog\CategoryController::class)->only('index', 'edit', 'update');

        // 作者 authors
        Route::resource('authors', AuthorController::class)->only('index', 'edit', 'update');
    });
});

require __DIR__.'/auth.php';
