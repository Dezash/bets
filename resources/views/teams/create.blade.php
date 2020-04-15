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
                $('<div class="form-group"><label for="first_name">First name</label><input class="form-control" name="first_name[]" type="text" value=""><label for="last_name">Last name</label><input class="form-control" name="last_name[]" type="text" value=""><label for="country">Country</label><input class="form-control" name="country[]" type="text" value=""><button type="button" class="btn btn-danger btnTrash"><i class="fa fa-trash"></i></button></div>').insertBefore(e.currentTarget);
            });

            $('form').on('click', '.btnTrash', function() {
                $(this)[0].parentNode.remove();
            });
        });
    </script>


    <h1>New team</h1>
    {{ Form::open(['action' => 'TeamController@store', 'method' => 'POST']) }}
        <div class="form-group">
            {{Form::label('name', "Name")}}
            {{Form::text('name', '', ['class' => 'form-control', 'required'])}}
            {{Form::label('search_box', 'League')}}
            {{Form::text('search_box', '', ['class' => 'form-control search', 'placeholder' => 'Search', 'data-route' => route('leagues.search'), 'data-updatefield' => 'leagueID', 'required'])}}
            {{Form::hidden('league_id', '', ['id' => 'leagueID'])}}
        </div>

        <button type="button" id="btnAdd" class="btn btn-success">Add player</button>
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {{ Form::close() }}
      
    @include('inc/search')

@endsection