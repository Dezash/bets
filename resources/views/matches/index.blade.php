@extends('layouts.app')

@section('content')
    <h1>Matches</h1>
    <a href="/matches/create" class="btn btn-primary float-right @cannot('create', App\Models\Match::class) disabled @endcannot">New match</a>
    @if(count($matches) > 0)
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Match start</th>
                <th scope="col">Match end</th>
                <th scope="col">First team</th>
                <th scope="col">Second team</th>
                <th scope="col">Winner</th>
            </tr>
        </thead>

        <tbody>
        @foreach($matches as $match)
            <tr>
                <th scope="row">{{$match->id}}</th>
                <th>{{$match->match_start}}</th>
                <th>{{$match->match_end}}</th>
                <th>{{$match->firstTeam->name}} [{{$match->first_team_score}}]</th>
                <th>{{$match->secondTeam->name}} [{{$match->second_team_score}}]</th>
                <th>{{isset($match->is_tie) ? ($match->is_tie == 1 ? 'Tie' : $match->winningTeam->name) : ''}}</th>
                <th><a href="/matches/{{$match->id}}/edit">Edit</a></th>
                <th><a href="/matches/{{$match->id}}/delete">Delete</a></th>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $matches->links() }}
    @else
        <p>No match records found</p>
    @endif
@endsection