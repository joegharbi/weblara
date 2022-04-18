@extends('layouts.main')
@section('content')

    <div class="container">
        <h2>Genres</h2>
        <div class="col-sm-3 my-3">
            <div class="card">
                <a href="{{ route('genres.create') }}" class="btn btn-secondary h-100 py-5">Create a new project</a>
            </div>
        </div>
        <div class="row">

            @foreach(\App\Models\Genre::all() as $genre)
                <div class="col-sm-3 my-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <a class="btn btn-primary" href="{{route('genres.show',['genre'=>$genre])}}">
                            <h5 class="card-title">{{ $genre['name'] }}</h5>
                            </a>
                            <p class="card-text">{{ $genre['style'] }}</p>
                            <p class="card-text"><small class="text-muted">Last modified: {{ $genre['updated_at'] }}</small></p>
                            <a href="{{ route('genres.edit',['genre'=>$genre]) }}" class="btn btn-outline-primary">Edit</a>
                            <form action="{{ route('genres.destroy', ['genre' => $genre['id']]) }}" method="post" class="d-inline">
                                @csrf
                                @method('delete')
                                <button class="btn btn-warning">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach


        </div>
    </div>
@endsection
