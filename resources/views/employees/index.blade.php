@extends('layouts.app')

@section('content')
    <h1>Employees</h1>
    <a href="/employees/create" class="btn btn-primary float-right">Naujas darbuotojas</a>
    @if(count($employees) > 0)
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Vardas</th>
                <th scope="col">Pavarde</th>
                <th scope="col">Gimimo data</th>
                <th scope="col">Pasamdymo data</th>
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
                <th><a href="/employees/{{$employee->id}}/edit">Koreguoti</a></th>
                <th><a href="/employees/{{$employee->id}}/edit">Trinti</a></th>
            </tr>
        @endforeach
        </tbody>
    </table>
    @else
        <p>Darbuotojo įrašai nerasti</p>
    @endif
@endsection