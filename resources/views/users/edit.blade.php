@extends('layouts.app')

@section('content')
    <h1>Edit user</h1>
    {{ Form::open(['action' => ['UsersController@update', $user->id], 'method' => 'POST']) }}
        <div class="form-group">
            {{Form::label('first_name', 'First name')}}
            {{Form::text('first_name', $user->first_name, ['class' => 'form-control', 'placeholder' => 'First name'])}}
            {{Form::label('last_name', "Last name")}}
            {{Form::text('last_name', $user->last_name, ['class' => 'form-control', 'placeholder' => 'Last name'])}}
            {{Form::label('personal_code', "Personal code")}}
            {{Form::text('personal_code', $user->personal_code, ['class' => 'form-control', 'placeholder' => 'Personal code'])}}
            {{Form::label('email', "Email")}}
            {{Form::email('email', $user->email, ['class' => 'form-control', 'placeholder' => 'example@gmail.com'])}}
            {{Form::label('phone', "Phone number")}}
            {{Form::text('phone', $user->phone, ['class' => 'form-control'])}}
            {{Form::label('birth_date', "Birth date")}}
            {{Form::date('birth_date', $user->birth_date, ['class' => 'form-control'])}}
            {{Form::label('balance', "Balance")}}
            {{Form::number('balance', $user->balance, ['class' => 'form-control'])}}
            {{Form::label('bank_account', "IBAN")}}
            {{Form::text('bank_account', $user->bank_account, ['class' => 'form-control'])}}
            {{Form::label('payment_type', "Payment type")}}
            {{Form::select('payment_type', [config('enums.payment_types')], $user->payment_type - 1, ['class' => 'form-control'])}}
            {{Form::checkbox('confirmed', 1, $user->confirmed, ['class' => 'form-check-input'])}}
            {{Form::label('confirmed', "Account confirmed", ['class' => 'form-check-label'])}}
        </div>
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {{ Form::close() }}
@endsection