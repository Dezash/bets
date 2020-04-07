@extends('layouts.app')

@section('content')
    <h1>New shop</h1>
    {{ Form::open(['action' => 'ShopController@store', 'method' => 'POST']) }}
        <div class="form-group">
            {{Form::label('search_box', 'City')}}
            {{Form::text('search_box', '', ['class' => 'form-control search', 'placeholder' => 'Search', 'data-route' => route('cities.search'), 'data-updatefield' => 'cityID', 'required'])}}
            {{Form::hidden('city_id', '', ['id' => 'cityID'])}}

            {{Form::label('address', 'Address')}}
            {{Form::text('address', '', ['class' => 'form-control'])}}
            {{Form::label('phone', 'Phone')}}
            {{Form::text('phone', '', ['class' => 'form-control'])}}
            {{Form::label('email', 'Email')}}
            {{Form::email('email', '', ['class' => 'form-control'])}}
            {{Form::label('opening_time', 'Opening time')}}
            {{Form::time('opening_time', '', ['class' => 'form-control'])}}
            {{Form::label('closing_time', 'Closing time')}}
            {{Form::time('closing_time', '', ['class' => 'form-control'])}}

            {{Form::label('search_box', 'Department')}}
            {{Form::text('search_box', '', ['class' => 'form-control search', 'placeholder' => 'Search', 'data-route' => route('shops.search'), 'data-updatefield' => 'departmentID', 'required'])}}
            {{Form::hidden('department_id', '', ['id' => 'departmentID'])}}
        </div>
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {{ Form::close() }}

    @include('inc/search')
@endsection