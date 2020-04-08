@extends('layouts.app')

@section('content')
    <h1>New match</h1>
    {{ Form::open(['action' => 'MatchController@store', 'method' => 'POST']) }}
        <div class="form-group">
            {{Form::label('match_start', "Match start")}}
            {{Form::input('dateTime-local', 'match_start', '', ['class' => 'form-control', 'required'])}}
            {{Form::label('match_end', "Match end")}}
            {{Form::input('dateTime-local', 'match_end', '', ['class' => 'form-control', 'required'])}}

            {{Form::label('search_box', 'First team')}}
            {{Form::text('search_box', '', ['class' => 'form-control search', 'placeholder' => 'Search', 'data-route' => route('teams.search'), 'data-updatefield' => 'firstTeamID', 'required'])}}
            {{Form::hidden('first_team', '', ['id' => 'firstTeamID'])}}

            {{Form::label('search_box', 'Second team')}}
            {{Form::text('search_box', '', ['class' => 'form-control search', 'placeholder' => 'Search', 'data-route' => route('teams.search'), 'data-updatefield' => 'secondTeamID', 'required'])}}
            {{Form::hidden('second_team', '', ['id' => 'secondTeamID'])}}
        </div>
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {{ Form::close() }}
      
    @include('inc/search')

@endsection