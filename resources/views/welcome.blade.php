@extends('layouts.main')
@section('content')
    <h1>Welcome</h1>
        <div class="container">
            <div>
                <p>
                    Number of active users {{$numUsers}}
                </p>
                <p>
                    Number of genres {{$numGenres}}
                </p>
                <p>
                    Number of books {{$numBooks}}
                </p>
                <p>
                    Number of active rents {{$numActRent}}
                </p>
            </div>
            <h5>
                List of Genres:
            </h5>
                <ul class="list-unstyled">
                    @foreach($listGenre as $lg)
                        <ul>
                            <li>
                                <a rel="stylesheet" href="{{route('genres.show',['genre'=>$lg])}}" >  {{$lg->name}}</a>
                            </li>
                        </ul>
                    @endforeach
                </ul>
        </div>

@endsection
