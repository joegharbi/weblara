@extends('layouts.main')
@section('content')
    <div class="container py-3">
        <h2>Create new Book</h2>
        <form action="{{route('books.store')}}" method="post">
            @csrf
            <div class="mb-3">
                <label for="title">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" value="{{ old('title') }}" name="title">
                @error('title')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="authors">Authors</label>
                <input type="text" class="form-control @error('authors') is-invalid @enderror" value="{{old('authors')}}" id="authors" name="authors" >
                @error('authors')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="released_at">Released at</label>
                <input type="date" class="form-control @error('released_at') is-invalid @enderror" value="{{old('released_at')}}" id="released_at" name="released_at">
                @error('released_at')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="pages">Pages</label>
                <input type="number" class="form-control @error('pages') is-invalid @enderror" value="{{old('pages')}}" id="pages" name="pages">
                @error('pages')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="isbn">ISBN</label>
                <input type="text" class="form-control @error('isbn') is-invalid @enderror" value="{{old('isbn')}}" id="isbn" name="isbn">
                @error('isbn')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description">Description</label>
                <textarea type="tex" class="form-control @error('description') is-invalid @enderror" value="{{old('description')}}" id="description" name="description"></textarea>
                @error('description')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div>
                Genres
            </div>
            @foreach(\App\Models\Genre::all() as $g)
            <div class="mb-3">
                    <input type="checkbox" value="{{'genres'}}" class="form-check-input" id="genres" name='genres'>
                    <label for="genres">{{$g->name}}</label>
            </div>
            @endforeach
            <div class="mb-3">
                <label for="in_stock">Pages</label>
                <input type="number" class="form-control @error('in_stock') is-invalid @enderror" value="{{old('in_stock')}}" id="in_stock" name="in_stock">
                @error('in_stock')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
