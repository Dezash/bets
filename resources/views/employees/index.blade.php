@extends('layouts.app')

@section('content')
    <h1>Employees</h1>
    <a href="/employees/create" class="btn btn-primary float-right">New employee</a>
    @if(count($employees) > 0)
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">First name</th>
                <th scope="col">Last name</th>
                <th scope="col">Birth date</th>
                <th scope="col">Hiring date</th>
            </tr>
        </thead>

        <tbody>
        @foreach($employees as $employee)
            <tr>
                <th scope="row"><a href="/employees/{{$employee->id}}">{{$employee->id}}</a></th>
                <th>{{$employee->first_name}}</th>
                <th>{{$employee->last_name}}</th>
                <th>{{$employee->birth_date}}</th>
                <th>{{date('Y-m-d', strtotime($employee->created_at))}}</th>
                <th><a href="/employees/{{$employee->id}}/edit">Edit</a></th>
                <th><a href="/employees/{{$employee->id}}/delete">Delete</a></th>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $employees->links() }}
    @else
        <p>No employee records found</p>
    @endif
@endsection