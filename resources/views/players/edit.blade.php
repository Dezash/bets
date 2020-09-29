@extends('layouts.app')

@section('content')
    <h1>Edit player</h1>
    {{ Form::open(['action' => ['PlayerController@update', $player->id], 'method' => 'POST']) }}
        <div class="form-group">
            {{Form::label('team_name', 'Team')}}
            {{Form::text('team_name', $player->team->name, ['class' => 'form-control search', 'placeholder' => 'Search', 'data-route' => route('teams.search'), 'data-updatefield' => 'teamID', 'required'])}}
            {{Form::hidden('team_id', $player->team_id, ['id' => 'teamID'])}}
            {{Form::label('first_name', "First name")}}
            {{Form::text('first_name', $player->first_name, ['class' => 'form-control', 'required'])}}
            {{Form::label('last_name', "Last name")}}
            {{Form::text('last_name', $player->last_name, ['class' => 'form-control', 'required'])}}
            {{Form::label('country', "Country")}}
            {{Form::text('country', $player->country, ['class' => 'form-control', 'required'])}}
        </div>
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {{ Form::close() }}

    @include('inc/search')

@endsection