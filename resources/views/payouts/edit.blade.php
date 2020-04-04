@extends('layouts.app')

@section('content')
    <h1>Edit payout</h1>
    {{ Form::open(['action' => ['PayoutsController@update', $payout->id], 'method' => 'POST']) }}
        <div class="form-group">
            {{Form::label('user_name', 'User')}}
            {{Form::text('user_name', $payout->user_name, ['class' => 'form-control', 'id' => 'search', 'placeholder' => 'User', 'required'])}}
            {{Form::hidden('user_id', $payout->user_id, ['id' => 'searchID'])}}
            {{Form::label('sum', "Sum")}}
            {{Form::text('sum', $payout->sum, ['class' => 'form-control', 'placeholder' => 'Sum', 'required'])}}
            {{Form::label('fee', "Fee")}}
            {{Form::text('fee', $payout->fee, ['class' => 'form-control', 'placeholder' => 'Fee', 'required'])}}
            {{Form::label('bank_account', "IBAN")}}
            {{Form::text('bank_account', $payout->bank_account, ['class' => 'form-control', 'required'])}}
            {{Form::label('payout_date', "Payout date")}}
            {{Form::date('payout_date', $payout->payout_date, ['class' => 'form-control', 'required'])}}
        </div>
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {{ Form::close() }}

    @include('inc/search', ['routeName' => 'users.search'])

@endsection