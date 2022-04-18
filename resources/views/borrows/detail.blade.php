@extends('layouts.main')
@section('content')
    <div class="container py-3">
        <h3>My Rentals</h3>
        <h6>Book Data:</h6>
        <h5>Title: <a href="{{route('books.show',['book'=>$borrow->book])}}">{{$borrow->book->title}}</h5></a>
        <p class="card-text">Authors: {{$borrow->book->authors}}</p>
        <p class="card-text">Released at: {{$borrow->book->released_at}}</p>
        <h6>Rental data:</h6>
        <p class="card-text">Borrower Name: {{$borrow->reader->name}}</p>
        <p class="card-text">Date of rental request: {{$borrow->created_at}}</p>
        <p class="card-text">Status: {{$borrow->status}}</p>
        @if($borrow->status != 'PENDING')
            <p class="card-text">Date of processing: {{$borrow->request_process_at}}</p>
            <p class="card-text">Request managed by: {{$borrow->managedRequests->name}}</p>
        @endif
        @if($borrow->status === 'RETURNED')
            <p class="card-text">Date of return: {{$borrow->returned_at}}</p>
            <p class="card-text">Return managed by: {{$borrow->managedReturns->name}}</p>
        @endif
        @if($borrow->deadline!=null and $borrow->deadline<now())
            <button class="btn btn-warning" disabled>Deadline already crossed {{$borrow->deadline}}</button>
        @endif
        @can('is_librarian')
            <form action="{{route('borrows.update',['borrow'=>$borrow])}}" method="post">
                @csrf
                @method('put')
                <div class="mb-3">
                    <label for="deadline">Deadline</label>
                    <input type="date" class="form-control @error('deadline') is-invalid @enderror"
                           value="{{old('deadline',$borrow->deadline)}}" id="deadline" name="deadline">
                    @error('deadline')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="status">Status</label>
                    <select name="status" class="form-control @error('status') is-invalid @enderror">
                        <option value="" selected disabled>Select Status</option>
                        <option value="PENDING" @selected(old('status',$borrow->status)=='PENDING')>
                            PENDING
                        </option>
                        <option value="REJECTED" @selected(old('status',$borrow->status)=='REJECTED')>
                            REJECTED
                        </option>
                        <option value="ACCEPTED" @selected(old('status',$borrow->status)=='ACCEPTED')>
                            ACCEPTED
                        </option>
                        <option value="RETURNED" @selected(old('status',$borrow->status)=='RETURNED')>
                            RETURNED
                        </option>
                        @error('status')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        @endcan
    </div>
@endsection
