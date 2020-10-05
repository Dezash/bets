@extends('layouts.app')

@section('content')
    <h1>Sports</h1>
    <a href="/sports/create" class="btn btn-primary float-right">New sport</a>
    @if(count($sports) > 0)
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
            </tr>
        </thead>

        <tbody>
        @foreach($sports as $sport)
            <tr>
                <th scope="row">{{$sport->id}}</th>
                <th>{{$sport->name}}</th>
                <th><a href="/sports/{{$sport->id}}/edit">Edit</a></th>
                <th><a href="/sports/{{$sport->id}}/delete">Delete</a></th>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $sports->links() }}
    @else
        <p>No sport records found</p>
    @endif
@endsection