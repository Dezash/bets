@extends('layouts.app')

@section('content')
    <h1>Edit match</h1>
    {{ Form::open(['action' => ['MatchController@update', $match->id], 'method' => 'POST']) }}
        <div class="form-group">
            {{Form::label('match_start', "Match start")}}
            {{Form::input('dateTime-local', 'match_start', date('Y-m-d\TH:i:s', strtotime($match->match_start)), ['class' => 'form-control', 'required'])}}
            {{Form::label('match_end', "Match end")}}
            {{Form::input('dateTime-local', 'match_end', date('Y-m-d\TH:i:s', strtotime($match->match_end)), ['class' => 'form-control', 'required'])}}

            {{Form::label('search_box', 'First team')}}
            {{Form::text('search_box', $match->firstTeam->name, ['class' => 'form-control search', 'placeholder' => 'Search', 'data-route' => route('teams.search'), 'data-updatefield' => 'firstTeamID', 'required'])}}
            {{Form::hidden('first_team', $match->first_team, ['id' => 'firstTeamID'])}}

            {{Form::label('first_team_score', "First team score")}}
            {{Form::number('first_team_score', $match->first_team_score, ['class' => 'form-control', 'required'])}}

            {{Form::label('search_box', 'Second team')}}
            {{Form::text('search_box', $match->secondTeam->name, ['class' => 'form-control search', 'placeholder' => 'Search', 'data-route' => route('teams.search'), 'data-updatefield' => 'secondTeamID', 'required'])}}
            {{Form::hidden('second_team', $match->second_team, ['id' => 'secondTeamID'])}}

            {{Form::label('second_team_score', "Second team score")}}
            {{Form::number('second_team_score', $match->second_team_score, ['class' => 'form-control', 'required'])}}
        </div>
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {{ Form::close() }}
    @include('inc/search')
@endsection