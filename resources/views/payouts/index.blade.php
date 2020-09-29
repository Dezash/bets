@extends('layouts.app')

@section('content')
    <h1>Payouts</h1>
    <a href="/payouts/create" class="btn btn-primary float-right">New payout</a>
    @if(count($payouts) > 0)
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">User</th>
                <th scope="col">Sum</th>
                <th scope="col">Fee</th>
                <th scope="col">Bank account</th>
                <th scope="col">Date</th>
            </tr>
        </thead>

        <tbody>
        @foreach($payouts as $payout)
            <tr>
                <th scope="row">{{$payout->id}}</th>
                <th><a href="/users/{{$payout->user_id}}">{{$payout->user->name}}</a></th>
                <th>{{$payout->sum}}</th>
                <th>{{$payout->fee}}</th>
                <th>{{$payout->bank_account}}</th>
                <th>{{$payout->payout_date}}</th>
                <th><a href="/payouts/{{$payout->id}}/edit">Edit</a></th>
                <th><a href="/payouts/{{$payout->id}}/delete">Delete</a></th>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $payouts->links() }}
    @else
        <p>No payout records found</p>
    @endif
@endsection