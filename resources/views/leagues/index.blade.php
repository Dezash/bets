@extends('layouts.app')

@section('content')
    <h1>Leagues</h1>
    <a href="/leagues/create" class="btn btn-primary float-right">New league</a>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Wins</th>
                <th scope="col">Losses</th>
                <th scope="col">Ties</th>
                <th scope="col">Sport</th>
            </tr>
        </thead>

        <tbody>
        @foreach($leagues as $league)
            <tr>
                <th scope="row">{{$league->id}}</th>
                <th>{{$league->name}}</th>
                <th>{{$league->wins}}</th>
                <th>{{$league->losses}}</th>
                <th>{{$league->ties}}</th>
                <th>{{$league->sport_name}}</th>
                <th><a href="/leagues/{{$league->id}}/edit">Edit</a></th>
                <th><a href="/leagues/{{$league->id}}/delete">Delete</a></th>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection