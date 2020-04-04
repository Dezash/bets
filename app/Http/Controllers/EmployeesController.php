<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use Illuminate\Support\Facades\DB;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $employees = Employee::all();
        $query = DB::select("SELECT * FROM employees");
        return view('employees.index')->with('employees', $query);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'birth_date' => 'required'
        ]);

        /*$employee = new Employee();
        $employee->first_name = $request->input('first_name');
        $employee->last_name = $request->input('last_name');
        $employee->birth_date = $request->input('birth_date');
        $employee->save();*/

        DB::insert("INSERT INTO employees (first_name, last_name, birth_date, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW())", [
            $request->input('first_name'),
            $request->input('last_name'),
            $request->input('birth_date')
        ]);

        return redirect('/employees')->with('success', "Darbuotojas sukurtas");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $query = DB::select("SELECT * FROM employees WHERE id = ?", [$id])[0];
        $object = compact('query')['query'];
        $object->created_at = \Carbon\Carbon::parse($object->created_at)->format('Y-m-d');

        return view('employees.show')->with('employee', compact('query')['query']);
        // $employee = Employee::fromArray($query);
        // return view('employees.show')->with('employee', $employee);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $query = DB::select("SELECT * FROM employees WHERE id = ?", [$id])[0];
        $object = compact('query')['query'];
        $object->created_at = \Carbon\Carbon::parse($object->created_at)->format('Y-m-d');

        return view('employees.edit')->with('employee', compact('query')['query']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'birth_date' => 'required',
            'created_at' => 'required'
        ]);

        $query = DB::update("UPDATE employees SET first_name = ?, last_name = ?, birth_date = ?, created_at = ? WHERE id = ?", [
            $request->input('first_name'),
            $request->input('last_name'),
            $request->input('birth_date'),
            $request->input('created_at'),
            $id]);

        return redirect('/employees')->with('success', "Darbuotojas atnaujintas");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::delete("DELETE FROM employees WHERE id = ?", [$id]);
        return redirect('/employees')->with('success', 'Employee deleted');
    }

    public function delete($id)
    {
        DB::delete("DELETE FROM employees WHERE id = ?", [$id]);
        return redirect('/employees')->with('success', 'Employee deleted');
    }
}
