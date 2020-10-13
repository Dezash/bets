@extends('layouts.app')

@section('content')
    <br>
    <a href="/employees" class="btn btn-primary">Atgal</a>
    <h1>{{$employee->first_name}} {{$employee->last_name}}</h1>
    <p>Hiring date: {{$employee->created_at}}</p>
    <br>
    <p>Birth date: {{$employee->birth_date}}</p>

    <div class="btn-group" role="group">
        <a href="/employees/{{$employee->id}}/edit" class="btn btn-warning">Edit</a>
        {!!Form::open(['action' => ['EmployeesController@destroy', $employee->id], 'method' => 'POST'])!!}
            {{Form::hidden('_method', "DELETE")}}
            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
        {!!Form::close()!!}
    </div>
@endsection