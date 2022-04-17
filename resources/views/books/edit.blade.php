@extends('layouts.main')
@section('content')
    <div class="container py-3">
        <h2>Edit Book</h2>
        <form action="{{route('books.update',['book'=>$book])}}" method="post">
            @csrf
            @method('put')

            <div class="mb-3">
                <label for="title">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                       value="{{ old('title',$book->title) }}" name="title">
                @error('title')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="authors">Authors</label>
                <input type="text" class="form-control @error('authors') is-invalid @enderror"
                       value="{{old('authors',$book->authors)}}" id="authors" name="authors" >
                @error('authors')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="released_at">Released at</label>
                <input type="date" class="form-control @error('released_at') is-invalid @enderror"
                       value="{{old('released_at',$book->released_at)}}" id="released_at" name="released_at">
                @error('released_at')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="pages">Pages</label>
                <input type="number" class="form-control @error('pages') is-invalid @enderror"
                       value="{{old('pages',$book->pages)}}" id="pages" name="pages">
                @error('pages')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="isbn">ISBN</label>
                <input type="text" class="form-control @error('isbn') is-invalid @enderror"
                       value="{{old('isbn',$book->isbn)}}" id="isbn" name="isbn">
                @error('isbn')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description">Description</label>
                <textarea type="tex" class="form-control @error('description') is-invalid @enderror"
                          value="{{old('description',$book->description)}}" id="description" name="description"></textarea>
                @error('description')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            {{--            <div>--}}
            {{--                Genres--}}
            {{--            </div>--}}
            {{--            @foreach(\App\Models\Genre::all() as $g)--}}
            {{--                    <div class="form-check">--}}
            {{--                    <input type="checkbox" value="{{$g->id}}"--}}
            {{--                    class="form-check-input  @error('genres[]') is-invalid @enderror"--}}
            {{--                           id="{{$g->id}}" name='genres[]'--}}
            {{--                    @checked($g->id||old('genres[]'))>--}}
            {{--                    <label for="genres[]">{{$g->name}}</label>--}}
            {{--                    </div>--}}
            {{--            @endforeach--}}
            {{--            @error('genres[]')--}}
            {{--            <div class="invalid-feedback">--}}
            {{--                {{$message}}--}}
            {{--            </div>--}}
            {{--            @enderror--}}
            <div class="mb-3">
                <label for="in_stock">Pages</label>
                <input type="number" class="form-control @error('in_stock') is-invalid @enderror"
                       value="{{old('in_stock',$book->in_stock)}}" id="in_stock" name="in_stock">
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
