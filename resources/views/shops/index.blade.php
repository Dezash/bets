@extends('layouts.app')

@section('content')
    <h1>Shops</h1>
    <a href="/shops/create" class="btn btn-primary float-right">New shop</a>
    @if(count($shops) > 0)
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">City</th>
                <th scope="col">Address</th>
                <th scope="col">Phone</th>
                <th scope="col">Email</th>
                <th scope="col">Opening time</th>
                <th scope="col">Closing time</th>
                <th scope="col">Department</th>
            </tr>
        </thead>

        <tbody>
        @foreach($shops as $shop)
            <tr>
                <th scope="row">{{$shop->id}}</th>
                <th>{{$shop->city->name}}</th>
                <th>{{$shop->address}}</th>
                <th>{{$shop->phone}}</th>
                <th>{{$shop->email}}</th>
                <th>{{$shop->opening_time}}</th>
                <th>{{$shop->closing_time}}</th>
                <th>{{$shop->department->address ?? "N/A"}}</th>
                
                <th><a href="/shops/{{$shop->id}}/edit">Edit</a></th>
                <th><a href="/shops/{{$shop->id}}/delete">Delete</a></th>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $shops->links() }}
    @else
        <p>No shop records found</p>
    @endif
@endsection