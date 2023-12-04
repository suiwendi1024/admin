<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $comments = Comment::latest('id')
            ->select([
                'id',
                'owner_name' => User::select('name')
                    ->whereColumn('users.id', 'user_id')
                    ->limit(1),
                'content',
                'created_at'
            ])
            ->when($request->search, function (Builder $query) use ($request) {
                return $query->whereHas('owner', function (Builder $q) use ($request) {
                    return $q->where('name', 'like', "%{$request->search}%");
                });
            })
            ->paginate($request->perPage);
        $comments->makeHidden([
            'updated_at',
            'owner',
        ]);

        return inertia('Blog/Comments/Index', [
            'comments' => fn() => $comments,
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
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
