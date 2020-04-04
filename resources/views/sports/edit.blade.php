@extends('layouts.app')

@section('content')
    <h1>Edit sport</h1>
    {{ Form::open(['action' => ['SportController@update', $sport->id], 'method' => 'POST']) }}
        <div class="form-group">
            {{Form::label('name', "Name")}}
            {{Form::text('name', $sport->name, ['class' => 'form-control', 'required'])}}
        </div>
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {{ Form::close() }}
@endsection