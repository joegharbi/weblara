@extends('layouts.main')
@section('content')
    <div class="container py-3">
        @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-block">
                <strong>{{ $message }}</strong>
            </div>
        @endif
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
                <textarea type="text" class="form-control @error('description') is-invalid @enderror"
                          id="description" name="description"> {{old('description',$book->description)}}</textarea>
                @error('description')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-group d-flex flex-wrap">
                @foreach ($genres as $genre)
                    <div class="custom-control custom-switch col-sm-2">
                        <input type="checkbox" class="custom-control-input" name="genres[]"
                               id="genre-{{ $genre['id'] }}" value="{{ $genre['id'] }}"
                               @if ($book->genres->contains($genre)) checked @endif
                            {{ (is_array(old('genres')) && in_array($genre['id'], old('genres'))) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="genre-{{ $genre['id'] }}">
                            {{ $genre['name'] }}
                        </label>
                    </div>
                @endforeach
            </div>
            <div class="mb-3">
                <label for="in_stock">In stock</label>
                <input type="number" class="form-control @error('in_stock') is-invalid @enderror"
                       value="{{old('in_stock',$book->in_stock)}}" id="in_stock" name="in_stock">
                @error('in_stock')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="language_code">Language code</label>
                <input type="text" class="form-control  @error('language_code') is-invalid @enderror"
                       value="{{old('language_code',$book->language_code)}}" id="language_code" name="language_code" >
                @error('language_code')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="cover_image">Cover image URL</label>
                <input type="text" name="cover_image" class="form-control @error('cover_image') is-invalid @enderror"
                       id="cover_image" value="{{ old('cover_image', $book->image_url) }}" placeholder="http://example.com/image.png">
                @error('cover_image')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
