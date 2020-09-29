@extends('layouts.app')

@section('content')
    <h1>New bet</h1>
    {{ Form::open(['action' => 'BetController@store', 'method' => 'POST']) }}
        <div class="form-group">
            {{Form::label('match_id', "Match ID")}}
            {{Form::select('match_id', $matches, null, ['class' => 'form-control', 'required'])}}
            {{Form::label('receipt_id', "Receipt ID")}}
            {{Form::select('receipt_id', $receipts, null, ['class' => 'form-control', 'required'])}}

            {{Form::label('team_name', 'Team')}}
            {{Form::text('team_name', '', ['class' => 'form-control search', 'placeholder' => 'Search', 'data-route' => route('teams.search'), 'data-updatefield' => 'teamID', 'required'])}}
            {{Form::hidden('team_id', '', ['id' => 'teamID'])}}

            {{Form::label('user_name', 'User')}}
            {{Form::text('user_name', '', ['class' => 'form-control search', 'placeholder' => 'Search', 'data-route' => route('users.search'), 'data-updatefield' => 'userID', 'required'])}}
            {{Form::hidden('user_id', '', ['id' => 'userID'])}}

            {{Form::label('bet_sum', "Sum")}}
            {{Form::number('bet_sum', '', ['class' => 'form-control', 'step' => 'any', 'required'])}}
        </div>
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {{ Form::close() }}
      
    @include('inc/search')

@endsection