<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $posts = Post::latest('id')
            ->select([
                'id',
                'title',
                'author_name' => User::select('name')
                    ->whereColumn('users.id', 'user_id')
                    ->limit(1),
                'category' => Category::select('name')
                    ->whereColumn('categories.id', 'category_id')
                    ->limit(1),
                'is_published',
                'is_locked',
                'created_at',
                'updated_at',
            ])
            ->when($request->search, function (Builder $query) use ($request) {
                return $query->where('title', 'like', "%{$request->search}%");
            })
            ->paginate($request->perPage);
        $posts->makeHidden([
            'content',
            'author',
        ]);

        return inertia('Blog/Posts/Index', [
            'posts' => fn() => $posts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
