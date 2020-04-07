@extends('layouts.app')

@section('content')
    <h1>Edit shop</h1>
    {{ Form::open(['action' => ['ShopController@update', $shop->id], 'method' => 'POST']) }}
        <div class="form-group">
            {{Form::label('search_box', 'City')}}
            {{Form::text('search_box', $shop->city_name, ['class' => 'form-control search', 'placeholder' => 'Search', 'data-route' => route('cities.search'), 'data-updatefield' => 'cityID', 'required'])}}
            {{Form::hidden('city_id', $shop->city_id, ['id' => 'cityID'])}}

            {{Form::label('address', 'Address')}}
            {{Form::text('address', $shop->address, ['class' => 'form-control'])}}
            {{Form::label('phone', 'Phone')}}
            {{Form::text('phone', $shop->phone, ['class' => 'form-control'])}}
            {{Form::label('email', 'Email')}}
            {{Form::email('email', $shop->email, ['class' => 'form-control'])}}
            {{Form::label('opening_time', 'Opening time')}}
            {{Form::time('opening_time', $shop->opening_time, ['class' => 'form-control'])}}
            {{Form::label('closing_time', 'Closing time')}}
            {{Form::time('closing_time', $shop->closing_time, ['class' => 'form-control'])}}

            {{Form::label('search_box', 'Department')}}
            {{Form::text('search_box', $department_address, ['class' => 'form-control search', 'placeholder' => 'Search', 'data-route' => route('shops.search'), 'data-updatefield' => 'departmentID', 'required'])}}
            {{Form::hidden('department_id', $shop->department, ['id' => 'departmentID'])}}
        </div>
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {{ Form::close() }}
    @include('inc/search')
@endsection