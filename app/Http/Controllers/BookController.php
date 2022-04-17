<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Borrow;
use App\Models\Genre;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Boolean;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('is_librarian');
        return view('books.index');
    }

//    /**
//     * Display a listing of the resource.
//     *
//     * @return \Illuminate\Http\Response
//     */
//    public function filter()
//    {
//        $books = QueryBuilder::for(\App\Models\Book::class)
//            ->allowedFilters('title','authors')
//            ->get();
//        return view('filter',['books'=>$books]);
//    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('is_librarian');
        $genres = Genre::all();
        return view('books.create',['genres'=>$genres]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBookRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookRequest $request)
    {
        $this->authorize('is_librarian');
        $data = $request->validated();
        $genre = Book::create($data);
        if (isset($data['genres'])) {
            $genre->genres()->attach($data['genres']);
        }
        return redirect()->route('books.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        $neb=Borrow::all()->where('status', '!=', 'ACCEPTED')->count();
        $nb=Book::all()->count();
        $numb=$nb-$neb;
        return view('books.show',[
            'book'=>$book,
            'neb'=>$numb,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $this->authorize('is_librarian');
        $genres = Genre::all();
        $book->load('genres');
        return view('books.edit', compact('book', 'genres'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBookRequest  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        $this->authorize('is_librarian');
        $data = $request->validated();
        $book->update($data);
        $book->genres()->sync($data['genres'] ?? []);
        return redirect()->route('books.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $this->authorize('is_librarian');
        $book->delete();
        return redirect()->route('books.index');
    }
}
