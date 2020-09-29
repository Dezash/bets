@extends('layouts.app')

@section('content')
    <h1>Bets</h1>
    <div class="float-right">
        <a href="/bets/create" class="btn btn-primary">New bet</a>
        <a href="/bets/report" class="btn btn-primary">Report</a>
    </div>
    @if(count($bets) > 0)
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Match ID</th>
                <th scope="col">Receipt ID</th>
                <th scope="col">Team name</th>
                <th scope="col">User</th>
                <th scope="col">Bet sum</th>
                <th scope="col">Date</th>
            </tr>
        </thead>

        <tbody>
        @foreach($bets as $bet)
            <tr>
                <th scope="row">{{$bet->id}}</th>
                <th>{{$bet->match_id}}</th>
                <th>{{$bet->receipt_id}}</th>
                <th>{{$bet->team->name}}</th>
                <th><a href="/users/{{$bet->user_id}}">{{$bet->user->name}}</a></th>
                <th>€{{$bet->bet_sum}}</th>
                <th>{{$bet->created_at}}</th>
                <th><a href="/bets/{{$bet->id}}/edit">Edit</a></th>
                <th><a href="/bets/{{$bet->id}}/delete">Delete</a></th>
            </tr>
        @endforeach
        </tbody>
    </table>
    @else
        <p>No bet records found</p>
    @endif
@endsection