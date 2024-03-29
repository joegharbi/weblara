@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="row">
            @if($books->count()===0)
                <h5>
                    No books found based on your filter
                </h5>
            @endif

            @foreach($books as $book)
                <div class="col-sm-3 my-3">
                    <div class="card h-100">
                        <img src="{{ $book->cover_image?: 'https://imagazin.hu/wp-content/uploads/2017/12/apple_music.png' }}" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">{{ $book->title }}</h5>
                            <p class="card-text">{{ $book->description }}</p>
                            <p class="card-text"><small class="text-muted">Last modified: {{ $book->updated_at }}</small></p>

                            <a href="{{ route('books.show', ['book' => $book->id]) }}" class="btn btn-primary">Open</a>
                            @can('is_librarian')
                            <a href="{{ route('books.edit',['book'=>$book->id]) }}" class="btn btn-outline-primary">Edit</a>
                            <form action="{{ route('books.destroy', ['book' => $book->id]) }}" method="post" class="d-inline">
                                @csrf
                                @method('delete')
                                <button class="btn btn-warning">Delete</button>
                            </form>
                            @endcan
                        </div>
                    </div>
                </div>
            @endforeach
            @can('is_librarian')
            <div class="col-sm-3 my-3">
                <div class="card h-100">
                    <a href="{{ route('books.create') }}" class="btn btn-secondary h-100 py-5">Create a new Book</a>
                </div>
            </div>
                @endcan
        </div>
    </div>
@endsection
