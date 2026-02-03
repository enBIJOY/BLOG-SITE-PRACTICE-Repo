<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


         // Create 5 blog posts
        $posts = Post::factory(5)->create();

        foreach ($posts as $post) {
            // Create 2-4 comments for each post
            Comment::factory(rand(2, 4))->create([
                'commentable_type' => 'App\Models\Post',
                'commentable_id' => $post->id,
                'parent_id' => null
            ]);

            // Get comments to add replies
            $comments = Comment::where('commentable_id', $post->id)
                ->whereNull('parent_id')
                ->get();

            foreach ($comments as $comment) {
                // Add 1-2 replies to some comments
                if (rand(0, 1)) {
                    Comment::factory(rand(1, 2))->create([
                        'commentable_type' => 'App\Models\Post',
                        'commentable_id' => $post->id,
                        'parent_id' => $comment->id
                    ]);
                }
            }
        }
        $this->call([
            GeneralSettingSeeder::class
        ]);
    }
}
