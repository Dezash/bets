@extends('layouts.app')

@section('content')
    <h1>Report</h1>
    <style>
    .form-inline > * {
    margin: 5px 5px;
    }
    </style>

    {{ Form::open(['action' => ['BetController@report'], 'method' => 'POST', 'class' => 'form-inline']) }}
    <div class="form-group">
        {{Form::date('date_from', '', ['class' => 'form-control', 'required'])}}
    </div>
    -
    <div class="form-group">
        {{Form::date('date_to', '', ['class' => 'form-control', 'required'])}}
    </div>
    <div class="form-group">
        {{Form::text('user_id', '', ['class' => 'form-control search', 'placeholder' => 'Search', 'data-route' => route('users.search'), 'data-updatefield' => 'userID'])}}
        {{Form::hidden('user_id', '', ['id' => 'userID'])}}
    </div>
        {{Form::submit('Report', ['class' => 'btn btn-primary'])}}
    {{ Form::close() }}
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Date</th>
                <th scope="col">Bet sum</th>
                <th scope="col">Team name</th>
            </tr>
        </thead>

        <tbody>
        @if(isset($reports))
        @for($i = 0; $i < count($reports); $i++)
        @if($i == 0 || $reports[$i]->id != $reports[$i - 1]->id)
        <tr><th scope="row" colspan="5" style="text-align: center;">{{$reports[$i]->first_name}} {{$reports[$i]->last_name}}</th></tr>
        @endif
        <tr>
            <td scope="row">#{{$reports[$i]->bet_id}}</td>
            <td>{{$reports[$i]->date}}</td>
            <td>{{$reports[$i]->bet_sum}}</td>
            <td>{{$reports[$i]->team_name}}</td>
        </tr>

        @if($i == count($reports) - 1 || $reports[$i]->id != $reports[$i + 1]->id)
        <tr>
            <th>Total bet sum: €{{$reports[$i]->total_bet_sum}}</th>
            <th>Total lost: €{{$reports[$i]->total_lost}}</th>
            <th>Total payouts: €{{$reports[$i]->total_paid}}</th>
            <th>Max bet: €{{$reports[$i]->max_bet}}</th>
            <th>Average bet: €{{$reports[$i]->avg_bet}}</th>
        </tr>
        @endif
        @endfor
        @endif
        </tbody>
    </table>

    @include('inc/search')
@endsection