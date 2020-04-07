@extends('layouts.app')

@section('content')
    <h1>Edit league</h1>
    {{ Form::open(['action' => ['LeagueController@update', $league->id], 'method' => 'POST']) }}
        <div class="form-group">
            {{Form::label('name', "Name")}}
            {{Form::text('name', $league->name, ['class' => 'form-control', 'required'])}}
            {{Form::label('wins', "Wins")}}
            {{Form::number('wins', $league->wins, ['class' => 'form-control', 'min:0', 'required'])}}
            {{Form::label('losses', "Losses")}}
            {{Form::number('losses', $league->losses, ['class' => 'form-control', 'min:0', 'required'])}}
            {{Form::label('ties', "Ties")}}
            {{Form::number('ties', $league->ties, ['class' => 'form-control', 'min:0', 'required'])}}
            {{Form::label('sport_name', 'Sport')}}
            {{Form::text('sport_name', $league->sport_name, ['class' => 'form-control search', 'placeholder' => 'Search', 'data-route' => route('sports.search'), 'data-updatefield' => 'sportID', 'required'])}}
            {{Form::hidden('sport_id', $league->sport_id, ['id' => 'sportID'])}}
        </div>
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {{ Form::close() }}
    @include('inc/search')
@endsection