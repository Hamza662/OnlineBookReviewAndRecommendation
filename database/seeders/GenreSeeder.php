<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genres = [
            ['genre_name' => 'Fiction', 'icon' => '📚'],
            ['genre_name' => 'Mystery', 'icon' => '🔍'],
            ['genre_name' => 'Romance', 'icon' => '💕'],
            ['genre_name' => 'Sci-Fi', 'icon' => '🚀'],
            ['genre_name' => 'Fantasy', 'icon' => '🧙‍♂️'],
            ['genre_name' => 'Thriller', 'icon' => '😱'],
            ['genre_name' => 'Biography', 'icon' => '👤'],
            ['genre_name' => 'History', 'icon' => '🏛️'],
            ['genre_name' => 'Self-Help', 'icon' => '💪'],
            ['genre_name' => 'Horror', 'icon' => '👻']
        ];

        foreach ($genres as $genre) {
            Genre::create($genre);
        }
    }
}
