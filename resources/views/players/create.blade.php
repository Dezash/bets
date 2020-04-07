@extends('layouts.app')

@section('content')
    <h1>New player</h1>
    {{ Form::open(['action' => 'PlayerController@store', 'method' => 'POST']) }}
        <div class="form-group">
            {{Form::label('search_box', 'Team')}}
            {{Form::text('search_box', '', ['class' => 'form-control search', 'placeholder' => 'Search', 'data-route' => route('teams.search'), 'data-updatefield' => 'teamID', 'required'])}}
            {{Form::hidden('team_id', '', ['id' => 'teamID'])}}
            {{Form::label('first_name', 'First name')}}
            {{Form::text('first_name', '', ['class' => 'form-control'])}}
            {{Form::label('last_name', 'Last name')}}
            {{Form::text('last_name', '', ['class' => 'form-control'])}}
            {{Form::label('country', 'Country')}}
            {{Form::text('country', '', ['class' => 'form-control'])}}
        </div>
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {{ Form::close() }}
      
    @include('inc/search')

@endsection