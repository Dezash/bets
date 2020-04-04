@extends('layouts.app')

@section('content')
    <h1>Edit receipt</h1>
    {{ Form::open(['action' => ['ReceiptController@update', $receipt->id], 'method' => 'POST']) }}
        <div class="form-group">
            {{Form::label('sum', "Sum")}}
            {{Form::number('sum', $receipt->sum, ['class' => 'form-control', 'min' => '0', 'step' => 'any', 'required'])}}
            {{Form::label('date_paid', "Date paid")}}
            {{Form::date('date_paid', $receipt->date_paid, ['class' => 'form-control'])}}
            {{Form::checkbox('paid', 1, $receipt->paid, ['class' => 'form-check-input'])}}
            {{Form::label('paid', "Paid", ['class' => 'form-check-label'])}}
        </div>
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {{ Form::close() }}
@endsection