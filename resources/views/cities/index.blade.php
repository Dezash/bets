@extends('layouts.app')

@section('content')
    <h1>Cities</h1>
    <a href="/cities/create" class="btn btn-primary float-right">New city</a>
    @if(count($cities) > 0)
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
            </tr>
        </thead>

        <tbody>
        @foreach($cities as $city)
            <tr>
                <th scope="row">{{$city->id}}</th>
                <th>{{$city->name}}</th>
                <th><a href="/cities/{{$city->id}}/edit">Edit</a></th>
                <th><a href="/cities/{{$city->id}}/delete">Delete</a></th>
            </tr>
        @endforeach
        </tbody>
    </table>
    @else
        <p>No city records found</p>
    @endif
@endsection