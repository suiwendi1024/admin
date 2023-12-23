<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $posts = Post::where(['is_published' => true, 'is_locked' => false])->get();

        for ($i = 0; $i < 200; $i++) {
            Comment::factory()
                ->for($users->random(), 'owner')
                ->for($posts->random(), 'commentable')
                ->create();
        }

        $comments = Comment::all();

        for ($i = 0; $i < 200; $i++) {
            /** @var Comment $parent */
            $parent = $comments->random();
            Comment::factory()
                ->for($users->random(), 'owner')
                ->for($parent, 'parent')
                ->for($parent->commentable, 'commentable')
                ->create();
        }
    }
}
