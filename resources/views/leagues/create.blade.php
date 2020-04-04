@extends('layouts.app')

@section('content')
    <h1>New league</h1>
    {{ Form::open(['action' => 'LeagueController@store', 'method' => 'POST']) }}
        <div class="form-group">
            {{Form::label('name', "Name")}}
            {{Form::text('name', '', ['class' => 'form-control', 'required'])}}
            {{Form::label('wins', "Wins")}}
            {{Form::number('wins', '0', ['class' => 'form-control', 'min' => '0', 'required'])}}
            {{Form::label('losses', "Losses")}}
            {{Form::number('losses', '0', ['class' => 'form-control', 'min' => '0', 'required'])}}
            {{Form::label('ties', "Ties")}}
            {{Form::number('ties', '0', ['class' => 'form-control', 'min' => '0', 'required'])}}
            {{Form::label('search_box', 'Sport')}}
            {{Form::text('search_box', '', ['class' => 'form-control', 'id' => 'search', 'placeholder' => 'Search', 'required'])}}
            {{Form::hidden('sport_id', '', ['id' => 'searchID'])}}
        </div>
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {{ Form::close() }}
      
    @include('inc/search', ['routeName' => 'sports.search'])

@endsection