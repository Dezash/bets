@extends('layouts.app')

@section('content')
    <h1>New sport</h1>
    {{ Form::open(['action' => 'SportController@store', 'method' => 'POST']) }}
        <div class="form-group">
            {{Form::label('name', 'Name')}}
            {{Form::text('name', '', ['class' => 'form-control'])}}
        </div>
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {{ Form::close() }}
@endsection