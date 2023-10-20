<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::create([
            'title' => 'Berita Bola Manchester City',
            'news_content' => 'Manchester City baru saja kalah dari Arsenal',
            'user_id' => 1
        ]);

        Post::create([
            'title' => 'Berita 2',
            'news_content' => 'Isi berita 2',
            'user_id' => 1
        ]);
    }
}
