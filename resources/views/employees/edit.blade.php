@extends('layouts.app')

@section('content')
    <h1>Edit employee</h1>
    {{ Form::open(['action' => ['EmployeesController@update', $employee->id], 'method' => 'POST']) }}
        <div class="form-group">
            {{Form::label('first_name', 'First name')}}
            {{Form::text('first_name', $employee->first_name, ['class' => 'form-control', 'placeholder' => 'First name'])}}
            {{Form::label('last_name', "Last name")}}
            {{Form::text('last_name', $employee->last_name, ['class' => 'form-control', 'placeholder' => 'Last name'])}}
            {{Form::label('birth_date', "Birth date")}}
            {{Form::date('birth_date', $employee->birth_date, ['class' => 'form-control'])}}
            {{Form::label('created_at', "Birth date")}}
            {{Form::date('created_at', $employee->created_at, ['class' => 'form-control'])}}
        </div>
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {{ Form::close() }}
@endsection