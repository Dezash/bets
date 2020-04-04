@extends('layouts.app')

@section('content')
    <h1>New receipt</h1>
    {{ Form::open(['action' => 'ReceiptController@store', 'method' => 'POST']) }}
        <div class="form-group">
            {{Form::label('sum', "Sum")}}
            {{Form::number('sum', '0', ['class' => 'form-control', 'min' => '0', 'step' => 'any', 'required'])}}
            {{Form::label('date_paid', "Date paid")}}
            {{Form::date('date_paid', '', ['class' => 'form-control'])}}
            {{Form::checkbox('paid', 1, 0, ['class' => 'form-check-input'])}}
            {{Form::label('paid', "Paid", ['class' => 'form-check-label'])}}
        </div>
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {{ Form::close() }}
@endsection