<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 3; $i++){
            $new_post = new Post();

            $new_post->title = 'Post title ' . ($i + 1);
            $new_post->slug = Str::slug($new_post->title, '-');
            $new_post->content = 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Error, tempore doloremque nemo ea animi sunt, magni at ab fugiat fugit dolor mollitia voluptas perferendis voluptate explicabo rerum sint assumenda corrupti?';

            $new_post->save();
        }
    }
}
