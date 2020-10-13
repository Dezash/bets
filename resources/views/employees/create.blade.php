@extends('layouts.app')

@section('content')
    <h1>Add employee</h1>
    {{ Form::open(['action' => 'EmployeesController@store', 'method' => 'POST']) }}
        <div class="form-group">
            {{Form::label('first_name', 'First name')}}
            {{Form::text('first_name', '', ['class' => 'form-control', 'placeholder' => 'First name'])}}
            {{Form::label('last_name', "Last name")}}
            {{Form::text('last_name', '', ['class' => 'form-control', 'placeholder' => 'Last name'])}}
            {{Form::label('birth_date', "Birht date")}}
            {{Form::date('birth_date', '', ['class' => 'form-control'])}}
        </div>
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {{ Form::close() }}
@endsection