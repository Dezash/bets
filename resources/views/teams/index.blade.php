@extends('layouts.app')

@section('content')
    <h1>Teams</h1>
    <a href="/teams/create" class="btn btn-primary float-right">New team</a>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">League</th>
                <th scope="col">Name</th>
            </tr>
        </thead>

        <tbody>
        @foreach($teams as $team)
            <tr>
                <th scope="row">{{$team->id}}</th>
                <th>{{$team->league_name}}</th>
                <th>{{$team->name}}</th>
                <th><a href="/teams/{{$team->id}}/edit">Edit</a></th>
                <th><a href="/teams/{{$team->id}}/delete">Delete</a></th>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection