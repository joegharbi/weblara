@extends('layouts.main')
@section('content')
    <div class="container py-3">
        <h2>Create new Genre</h2>
        <form action="{{route('genres.store')}}" method="post">
            @csrf
            <div class="mb-3">
                <label for="name">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                       value="{{ old('name') }}" name="name">
                @error('name')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="style">Style</label>
                <select name="style" class="form-control @error('style') is-invalid @enderror">
                    <option value="" selected disabled>Select Style</option>
                    <option value="primary" @selected(old('style')=='primary')>
                        Primary
                    </option>
                    <option value="secondary" @selected(old('style')=='secondary')>
                        Secondary
                    </option>
                    <option value="success" @selected(old('style')=='success')>
                        Success
                    </option>
                    <option value="danger" @selected(old('style')=='danger')>
                        Danger
                    </option>
                    <option value="warning" @selected(old('style')=='warning')>
                        Warning
                    </option>
                    <option value="info" @selected(old('style')=='info')>
                        Info
                    </option>
                    <option value="light" @selected(old('style')=='light')>
                        Light
                    </option>
                    <option value="dark" @selected(old('style')=='dark')>
                        Dark
                    </option>
                    @error('style')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror

                </select>

            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
