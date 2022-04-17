@extends('layouts.main')
@section('content')
    <div class="container py-3">
        <h2>Title: {{$book->title}}</h2>
        <form action="{{route('borrows.store',['book'=>$book])}}" method="POST">
            @csrf
            <div>
                <div>
                    {{$book->authors}}
                </div>
                @foreach($book->genres as $gn)
                    <li>
                        {{$gn->name}}
                    </li>
                @endforeach
                {{$book->released_at}}
                {{$book->pages}}
                {{$book->language_code}}
                <div>
                    {{$book->isbn}}
                </div>
                <div>
                    {{$book->in_stock}}
                </div>
                Available Books:{{$neb}}
                <div>
                    {{$book->description}}
                </div>
            </div>
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
                @can('is_librarian')
                               <a href="{{ route('books.edit',['book'=>$book]) }}" class="btn btn-outline-primary">Edit</a>
                               <form action="{{ route('books.destroy', ['book' => $book['id']]) }}" method="post" class="d-inline">
                                   @csrf
                                   @method('delete')
                                   <button class="btn btn-warning">Delete</button>
                               </form>
                           @endcan
            @endauth
            @guest()
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" disabled>Login to borrow this book</button>
                </div>
            @endguest
        </form>
    </div>

@endsection
