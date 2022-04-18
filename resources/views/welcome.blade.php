@extends('layouts.main')
@section('content')
    <h1>Welcome</h1>
    <div class="input-group">
    <form action="{{ route('filter') }}" method="get" class="input-group">
        <input type="search" name="filter" id="filter" class="form-control rounded"
               placeholder="Search by title or authors" aria-label="Search"/>
{{--        <button type="button" class="btn btn-outline-primary">search</button>--}}
    </form>
    </div>
    <ul class="list-group">
        <li class="list-group-item">
            Number of active users <span class="badge bg-primary rounded-pill">{{$numUsers}}</span>
        </li>
        <li class="list-group-item">
            Number of genres <span class="badge bg-primary rounded-pill">{{$numGenres}}</span>
        </li>
        <li class="list-group-item">
            Number of books <span class="badge bg-primary rounded-pill">{{$numBooks}}</span>
        </li>
        <li class="list-group-item">
            Number of active rents <span class="badge bg-primary rounded-pill">{{$numActRent}}</span>
        </li>
    </ul>
    <h2>Genres</h2>
    <div class="row">

        @foreach(\App\Models\Genre::all() as $genre)
            <div class="col-sm-3 my-3">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a class="btn btn-primary" href="{{route('genres.show',['genre'=>$genre])}}">{{ $genre['name'] }}
                        </a>
                        </h5>
                        <p class="card-text"><h6>
                            {{ $genre['style'] }}</p>
                        </h6>
                        <p class="card-text"><small class="text-muted">Last modified: {{ $genre['updated_at'] }}</small></p>
                       @can('is_librarian')
                        <a href="{{ route('genres.edit',['genre'=>$genre]) }}" class="btn btn-outline-primary">Edit</a>
                        <form action="{{ route('genres.destroy', ['genre' => $genre['id']]) }}" method="post" class="d-inline">
                            @csrf
                            @method('delete')
                            <button class="btn btn-warning">Delete</button>
                        </form>
                        @endcan
                    </div>
                </div>
            </div>
        @endforeach




@endsection
