@extends('layouts.app')

@section('content')
    <h1>New payout</h1>
    {{ Form::open(['action' => 'PayoutsController@store', 'method' => 'POST']) }}
        <div class="form-group">
            {{Form::label('search_box', 'User')}}
            {{Form::text('search_box', '', ['class' => 'form-control', 'id' => 'search', 'placeholder' => 'Search', 'required'])}}
            {{Form::hidden('user_id', '', ['id' => 'searchID'])}}
            {{Form::label('sum', "Sum")}}
            {{Form::number('sum', '', ['class' => 'form-control', 'step' => 'any', 'min' => '0', 'required'])}}
            {{Form::label('fee', "Fee")}}
            {{Form::number('fee', '', ['class' => 'form-control', 'step' => 'any', 'min' => '0', 'required'])}}
            {{Form::label('bank_account', 'IBAN')}}
            {{Form::text('bank_account', '', ['class' => 'form-control'])}}
        </div>
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {{ Form::close() }}
      
    @include('inc/search', ['routeName' => 'users.search'])

@endsection