@extends('layouts.main')
@section('content')
    <div class="container py-3">
        <h2>Title: {{$book->title}}</h2>
        <form action="#" method="POST">
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
                @if((auth()->user()->is_librarian===0) && ($book->borrows->where('book_id','===',$book->id)->first() !=null))
                    @if((auth()->id()===$book->borrows->where('book_id','===',$book->id)->first()->reader_id)&&($book->borrows->where('book_id','===',$book->id)->first()->status!='RETURNED'))
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
                @else
                    <div class="form-group">
                        <h5>
                            You don't have an ongoing request with this book
                        </h5>

                        <button type="submit" class="btn btn-primary">Borrow this book</button>
                    </div>
                @endif
            @endauth
            @guest()
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" disabled>Login to borrow this book</button>
                </div>
            @endguest
        </form>
    </div>

@endsection
