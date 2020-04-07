@extends('layouts.app')

@section('content')
    <h1>New city</h1>
    {{ Form::open(['action' => 'CityController@store', 'method' => 'POST']) }}
        <div class="form-group">
            {{Form::label('name', 'Name')}}
            {{Form::text('name', '', ['class' => 'form-control'])}}
        </div>
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {{ Form::close() }}
@endsection