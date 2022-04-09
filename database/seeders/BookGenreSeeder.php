<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookGenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('book_genre')->truncate();
        $books=Book::all();
        $genres=Genre::all();
        foreach ($books as $b){
            foreach ($genres as $g){
                $b->genres()->attach($g->id);
            }
        }
    }
}
