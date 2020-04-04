@extends('layouts.app')

@section('content')
    <h1>Edit team</h1>
    {{ Form::open(['action' => ['TeamController@update', $team->id], 'method' => 'POST']) }}
        <div class="form-group">
            {{Form::label('name', "Name")}}
            {{Form::text('name', $team->name, ['class' => 'form-control', 'required'])}}
            {{Form::label('league_name', 'League')}}
            {{Form::text('league_name', $team->league_name, ['class' => 'form-control', 'id' => 'search', 'placeholder' => 'Search', 'required'])}}
            {{Form::hidden('league_id', $team->league_id, ['id' => 'searchID'])}}
        </div>
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {{ Form::close() }}
    @include('inc/search', ['routeName' => 'leagues.search'])
@endsection