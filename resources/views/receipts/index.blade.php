@extends('layouts.app')

@section('content')
    <h1>Receipts</h1>
    <a href="/receipts/create" class="btn btn-primary float-right @cannot('create', App\Models\Receipt::class) disabled @endcannot">New receipt</a>
    @if(count($receipts) > 0)
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Sum</th>
                <th scope="col">Paid</th>
                <th scope="col">Date paid</th>
                <th scope="col">Date issued</th>
            </tr>
        </thead>

        <tbody>
        @foreach($receipts as $receipt)
            <tr>
                <th scope="row">{{$receipt->id}}</th>
                <th>{{$receipt->sum}}</th>
                <th>{{$receipt->paid ? 'Yes' : 'No'}}</th>
                <th>{{$receipt->date_paid}}</th>
                <th>{{$receipt->created_at}}</th>
                <th><a href="/receipts/{{$receipt->id}}/edit">Edit</a></th>
                <th><a href="/receipts/{{$receipt->id}}/delete">Delete</a></th>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $receipts->links() }}
    @else
        <p>No receipt records found</p>
    @endif
@endsection