@extends('layouts.app')

@section('content')
    <h1>New team</h1>
    {{ Form::open(['action' => 'TeamController@store', 'method' => 'POST']) }}
        <div class="form-group">
            {{Form::label('name', "Name")}}
            {{Form::text('name', '', ['class' => 'form-control', 'required'])}}
            {{Form::label('search_box', 'League')}}
            {{Form::text('search_box', '', ['class' => 'form-control', 'id' => 'search', 'placeholder' => 'Search', 'required'])}}
            {{Form::hidden('league_id', '', ['id' => 'searchID'])}}
        </div>
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {{ Form::close() }}
      
    @include('inc/search', ['routeName' => 'leagues.search'])

@endsection