@extends('layouts.main')
@section('content')
    @foreach($books as $bk)
        <li>
            <a href="{{route('books.show',['book'=>$bk])}}">
                {{$bk->title}}
            </a>
        </li>
    @endforeach
@endsection
