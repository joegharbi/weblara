@extends('layouts.main')
@section('content')
    <h2>Profile</h2>
    <h5>User Name: {{$user->name}}</h5>
    <h5>Email address: {{$user->email}}</h5>
    @if($user->is_librarian)
    <h5>Role: Librarian</h5>
    @else
        Role: Reader
    @endif
@endsection
