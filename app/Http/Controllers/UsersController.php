<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('users.index')->with('users', User::paginate(15))->with('payment_types', config('enums.payment_types'));
    }

        /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show')->with('user', $user);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit')->with('user', $user);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
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

        $bSuccess = $user->update($request->all());
        return redirect('/users')->with($bSuccess ? 'success' : 'error', $bSuccess ? 'User updated' : 'Failed to update user');
    }

        /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect('/users')->with('success', 'User deleted');
    }

    public function delete($id)
    {
        User::destroy($id);
        return redirect('/users')->with('success', 'User deleted');
    }


    public function getUsers(Request $request){

        $search = $request->search;
  
        if($search == '')
        {
           $users = User::select('id', 'name')->orderBy('name')->limit(5)->get();
        }
        else
        {
           $users = User::select('id', 'name')->where('name', 'like', '%' . $search . '%')->orderBy('name')->limit(5)->get();
        }
  
        $response = array();
        foreach($users as $user)
        {
           $response[] = ["value" => $user->id, "label" => $user->name];
        }
  
        echo json_encode($response);
        exit;
     }
}
