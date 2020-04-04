@extends('layouts.app')

@section('content')
    <h1>Users</h1>
    @if(count($users) > 0)
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">First name</th>
                    <th scope="col">Last name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Personal code</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Birth date</th>
                    <th scope="col">Balance</th>
                    <th scope="col">IBAN</th>
                    <th scope="col">Payment type</th>
                    <th scope="col">Confirmed</th>
                </tr>
            </thead>

            <tbody>
            @foreach($users as $user)
                <tr>
                    <th scope="row">{{$user->id}}</th>
                    <th>{{$user->first_name}}</th>
                    <th>{{$user->last_name}}</th>
                    <th>{{$user->email}}</th>
                    <th>{{$user->personal_code}}</th>
                    <th>{{$user->phone}}</th>
                    <th>{{$user->birth_date}}</th>
                    <th>{{$user->balance}}</th>
                    <th>{{$user->bank_account}}</th>
                    <th>{{$payment_types[$user->payment_type - 1]}}</th>
                    <th>{{$user->confirmed ? 'Yes' : 'No'}}</th>
                    <th><a href="/users/{{$user->id}}/edit">Edit</a></th>
                    <th><a href="/users/{{$user->id}}/delete">Delete</a></th>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @else
        <p>No users found</p>
    @endif
@endsection