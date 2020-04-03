@extends('layouts.app')

@section('content')
    <h1>Sukurti darbuotoją</h1>
    {{ Form::open(['action' => 'EmployeesController@store', 'method' => 'POST']) }}
        <div class="form-group">
            {{Form::label('first_name', 'Vardas')}}
            {{Form::text('first_name', '', ['class' => 'form-control', 'placeholder' => 'Vardas'])}}
            {{Form::label('last_name', "Pavardė")}}
            {{Form::text('last_name', '', ['class' => 'form-control', 'placeholder' => 'Pavardė'])}}
            {{Form::label('birth_date', "Gimimo data")}}
            {{Form::date('birth_date', '', ['class' => 'form-control'])}}
        </div>
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {{ Form::close() }}
@endsection