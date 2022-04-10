@extends('layouts.main')
@section('content')
    <div>
        <h5>
            Title: {{$book->title}}
        </h5>
    </div>
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
@endsection
