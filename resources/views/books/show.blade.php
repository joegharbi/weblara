@extends('layouts.main')
@section('content')
    <div class="container py-1">
    <h4>Book detail</h4>



<div class="card mb-3" style="max-width: 1000px;">

    <div class="row g-0">
        <div class="col-md-4">
            <img
                src="{{$book->cover_image}}"
                alt="Trendy Pants and Shoes"
                class="img-fluid rounded-start"
            />
            @can('is_librarian')
                <a href="{{ route('books.edit',['book'=>$book]) }}" class="btn btn-outline-primary">Edit</a>
                <form action="{{ route('books.destroy', ['book' => $book['id']]) }}" method="post" class="d-inline">
                    @csrf
                    @method('delete')
                    <button class="btn btn-warning">Delete</button>
                </form>
            @endcan
        </div>
        <div class="col-md-8">
            <form class="card-body" action="{{route('borrows.store',['book'=>$book])}}" method="POST">
                @csrf
                <h5 class="card-title">{{$book->title}}</h5>
                <p class="card-text">
                    {{$book->description}}
                </p>
                <p>
                    Authors:  {{$book->authors}}
                </p>
                Genres:

                @foreach($book->genres as $gn)
                    <li>
                        {{$gn->name}}
                    </li>
                @endforeach
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Language code: {{$book->language_code}}</li>
                    <li class="list-group-item">Book pages: {{$book->pages}}</li>
                    <li class="list-group-item">ISBN: {{$book->isbn}}</li>
                    <li class="list-group-item">In stock:  {{$book->in_stock}}</li>
                    <li class="list-group-item">Available Books: {{$book->in_stock-$book->activeBorrows()->count()}}</li>
                </ul>
                <p class="card-text">
                    <small class="text-muted">Released at: {{$book->released_at}}</small>
                </p>
                @auth()
                    @cannot('is_librarian')
                        @if($book->ongoingBorrows->isNotEmpty())
                            <div class="form-group">
                                <h5>
                                    You already have an ongoing request with this book
                                </h5>
                                <button type="submit" class="btn btn-primary" disabled>Borrow this book</button>
                            </div>
                        @else
                            <div class="form-group">
                                <h5>
                                    You don't have an ongoing request with this book
                                </h5>
                                <button type="submit" class="btn btn-primary">Borrow this book</button>
                            </div>
                        @endif
                    @endcannot
                @endauth
                @guest()
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" disabled>Login to borrow this book</button>
                    </div>
                @endguest
            </form>
            </div>
        </div>
    </div>
</div>
    </div>
@endsection
