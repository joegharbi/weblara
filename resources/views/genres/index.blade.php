@extends('layout')
@section('content')
    @foreach($genres as $g)
        <li>
            {{$g->name}}
        </li>
    @endforeach
@endsection
