@extends('layouts.app')

@section('content')
    <h1>Players</h1>
    <a href="/players/create" class="btn btn-primary float-right">New player</a>
    @if(count($players) > 0)
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Team</th>
                <th scope="col">First name</th>
                <th scope="col">Last name</th>
                <th scope="col">Country</th>
            </tr>
        </thead>

        <tbody>
        @foreach($players as $player)
            <tr>
                <th scope="row">{{$player->id}}</th>
                <th>{{$player->team->name}}</th>
                <th>{{$player->first_name}}</th>
                <th>{{$player->last_name}}</th>
                <th>{{$player->country}}</th>
                <th><a href="/players/{{$player->id}}/edit">Edit</a></th>
                <th><a href="/players/{{$player->id}}/delete">Delete</a></th>
            </tr>
        @endforeach
        </tbody>
    </table>
    @else
        <p>No player records found</p>
    @endif
@endsection