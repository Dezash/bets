<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = DB::select("SELECT * FROM users");
        return view('users.index')->with('users', $users)->with('payment_types', config('enums.payment_types'));
    }

        /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $query = DB::select("SELECT * FROM users WHERE id = ?", [$id])[0];
        return view('users.show')->with('user', compact('query')['query']);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $query = DB::select("SELECT * FROM users WHERE id = ?", [$id])[0];
        return view('users.edit')->with('user', compact('query')['query']);
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
            'email' => ['required', 'string', 'email', 'max:255'],
            'personal_code' => ['required', 'min:11', 'max:11'],
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'phone' => ['required'],
            'birth_date' => ['required', 'date'],
            'bank_account' => ['nullable'],
            'payment_type' => ['required', 'numeric', 'min:1', 'max:' . count(config('enums.payment_types'))]
        ]);

        $query = DB::update("UPDATE users SET email = ?, personal_code = ?, first_name = ?, last_name = ?, phone = ?, birth_date = ?, bank_account = ?, payment_type = ?, confirmed = ? WHERE id = ?", [
            $request->input('email'),
            $request->input('personal_code'),
            $request->input('first_name'),
            $request->input('last_name'),
            $request->input('phone'),
            $request->input('birth_date'),
            $request->input('bank_account'),
            $request->input('payment_type') + 1,
            $request->input('confirmed') == 1 ? 1 : 0,
            $id
            ]);

        return redirect('/users')->with('success', "User updated");
    }

        /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::delete("DELETE FROM users WHERE id = ?", [$id]);
        return redirect('/users')->with('success', 'User deleted');
    }

    public function delete($id)
    {
        DB::delete("DELETE FROM users WHERE id = ?", [$id]);
        return redirect('/users')->with('success', 'User deleted');
    }
}
