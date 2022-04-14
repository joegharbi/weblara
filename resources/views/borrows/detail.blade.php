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
        @if($borrow->deadline>now())
            <button class="btn btn-warning" disabled>Deadline already crossed</button>
        @endif
    </div>
@endsection
