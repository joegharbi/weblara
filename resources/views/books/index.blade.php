@extends('layouts.main')

@section('content')

    <div class="container">
        <div class="row">

            @foreach(\App\Models\Book::all() as $book)
                <div class="col-sm-3 my-3">
                    <div class="card h-100">
                        <img src="{{ $book['cover_image'] ?: 'https://imagazin.hu/wp-content/uploads/2017/12/apple_music.png' }}" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">{{ $book['title'] }}</h5>
                            <p class="card-text">{{ $book['description'] }}</p>
                            <p class="card-text"><small class="text-muted">Last modified: {{ $book['updated_at'] }}</small></p>
                            @cannot('is_librarian')
                            <a href="{{ route('books.show', ['book' => $book['id']]) }}" class="btn btn-primary">Open</a>
                            @endcannot
                            @can('is_librarian')
                            <a href="{{ route('books.show', ['book' => $book['id']]) }}" class="btn btn-primary">Open</a>
                            <a href="{{ route('books.edit',['book'=>$book]) }}" class="btn btn-outline-primary">Edit</a>
                            <form action="{{ route('books.destroy', ['book' => $book['id']]) }}" method="post" class="d-inline">
                            @csrf
                            @method('delete')
                            <button class="btn btn-warning">Delete</button>
                            </form>
                            @endcan
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

@endsection
