@extends('layouts.app')

@section('content')
    <h1>New team</h1>
    {{ Form::open(['action' => 'TeamController@store', 'method' => 'POST']) }}
        <div class="form-group">
            {{Form::label('name', "Name")}}
            {{Form::text('name', '', ['class' => 'form-control', 'required'])}}
            {{Form::label('search_box', 'League')}}
            {{Form::text('search_box', '', ['class' => 'form-control search', 'placeholder' => 'Search', 'data-route' => route('leagues.search'), 'data-updatefield' => 'leagueID', 'required'])}}
            {{Form::hidden('league_id', '', ['id' => 'leagueID'])}}
        </div>
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {{ Form::close() }}
      
    @include('inc/search')

@endsection