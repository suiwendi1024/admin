<?php

use App\Http\Controllers\Blog\AuthorController;
use App\Http\Controllers\Blog\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Shop\CustomerController;
use App\Http\Controllers\Shop\OrderController;
use App\Http\Controllers\Shop\ProductController;
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
        Route::get('products', [ProductController::class, 'index'])->name('products.index');

        // 订单 orders
        Route::get('orders', [OrderController::class, 'index'])->name('orders.index');

        // 产品分类 categories
        Route::get('categories', [\App\Http\Controllers\Shop\CategoryController::class, 'index'])->name('categories.index');

        // 顾客 customers
        Route::get('customers', [CustomerController::class, 'index'])->name('customers.index');
    });

    // 博客 blog
    Route::prefix('blog')->name('blog.')->group(function () {
        // 帖子 posts
        Route::get('posts', [PostController::class, 'index'])->name('posts.index');

        // 评论 comments
        Route::get('comments', [\App\Http\Controllers\Blog\CommentController::class, 'index'])->name('comments.index');

        // 帖子分类 categories
        Route::get('categories', [\App\Http\Controllers\Blog\CategoryController::class, 'index'])->name('categories.index');

        // 作者 authors
        Route::get('authors', [AuthorController::class, 'index'])->name('authors.index');
    });
});

require __DIR__.'/auth.php';
