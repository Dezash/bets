@extends('layouts.app')

@section('content')
    <h1>Koreguoti darbuotoją</h1>
    {{ Form::open(['action' => ['EmployeesController@update', $employee->id], 'method' => 'POST']) }}
        <div class="form-group">
            {{Form::label('first_name', 'Vardas')}}
            {{Form::text('first_name', $employee->first_name, ['class' => 'form-control', 'placeholder' => 'Vardas'])}}
            {{Form::label('last_name', "Pavardė")}}
            {{Form::text('last_name', $employee->last_name, ['class' => 'form-control', 'placeholder' => 'Pavardė'])}}
            {{Form::label('birth_date', "Gimimo data")}}
            {{Form::date('birth_date', $employee->birth_date, ['class' => 'form-control'])}}
            {{Form::label('created_at', "Pasamdymo data")}}
            {{Form::date('created_at', $employee->created_at, ['class' => 'form-control'])}}
        </div>
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {{ Form::close() }}
@endsection