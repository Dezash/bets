@extends('layouts.app')

<style>
    .form-group { 
        border: 2px solid #ced4da !important;
        padding: 20px;
        border-radius: 20px;
    }
</style>

@section('content')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#btnAdd').click(function(e) {
                $('<div class="form-group"><label for="teamname">Team name</label><input class="form-control" required="" name="teamname[]" type="text" value=""><button type="button" class="btn btn-danger btnTrash"><i class="fa fa-trash"></i></button></div>').insertBefore(e.currentTarget);
            });

            $('form').on('click', '.btnTrash', function() {
                $(this)[0].parentNode.remove();
            });
        });
    </script>

    <h1>New league</h1>
    {{ Form::open(['action' => 'LeagueController@store', 'method' => 'POST']) }}

        <div class="form-group">
            {{Form::label('name', "Name")}}
            {{Form::text('name', '', ['class' => 'form-control', 'required'])}}
            {{Form::label('wins', "Wins")}}
            {{Form::number('wins', '0', ['class' => 'form-control', 'min' => '0', 'required'])}}
            {{Form::label('losses', "Losses")}}
            {{Form::number('losses', '0', ['class' => 'form-control', 'min' => '0', 'required'])}}
            {{Form::label('ties', "Ties")}}
            {{Form::number('ties', '0', ['class' => 'form-control', 'min' => '0', 'required'])}}
            {{Form::label('search_box', 'Sport')}}
            {{Form::text('search_box', '', ['class' => 'form-control search', 'placeholder' => 'Search', 'data-route' => route('sports.search'), 'data-updatefield' => 'sportID', 'required'])}}
            {{Form::hidden('sport_id', '', ['id' => 'sportID'])}}
        </div>

        <button type="button" id="btnAdd" class="btn btn-success">Add team</button>
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {{ Form::close() }}
      
    @include('inc/search')

@endsection