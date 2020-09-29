<?php

namespace App\Http\Controllers;

use App\Payout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PayoutsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payouts = Payout::select('payouts.*', 'users.name AS user_name')->join('users', 'payouts.user_id', '=', 'users.id')->get();
        return view('payouts.index')->with('payouts', $payouts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('payouts.create');
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
            'user_id' => ['required', 'numeric'],
            'sum' => ['required', 'numeric', 'min:0'],
            'fee' => ['required', 'numeric', 'min:0'],
            'bank_account' => ['required']
        ]);

        Payout::create($request->all());

        return redirect('/payouts')->with('success', "Payout created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payout  $payout
     * @return \Illuminate\Http\Response
     */
    public function show(Payout $payout)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payout  $payout
     * @return \Illuminate\Http\Response
     */
    public function edit(Payout $payout)
    {
        $payout = Payout::select('payouts.*', 'users.name AS user_name')->join('users', 'payouts.user_id', '=', 'users.id')->where('payouts.id', $payout->id)->first();
        return view('payouts.edit')->with('payout', $payout);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payout  $payout
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payout $payout)
    {
        $this->validate($request, [
            'user_id' => ['required'],
            'sum' => ['required', 'min:0'],
            'fee' => ['required', 'min:0'],
            'bank_account' => ['required', 'string'],
            'payout_date' => ['required']
        ]);

        $bSuccess = $payout->update($request->all());

        return redirect('/payouts')->with($bSuccess ? 'success' : 'error', $bSuccess ? 'Payout updated' : 'Failed to update payout');
    }

    public function destroy(Payout $payout)
    {
        $payout->delete();
        return redirect('/payouts')->with('success', 'Payout deleted');
    }

    public function delete($id)
    {
        Payout::destroy($id);
        return redirect('/payouts')->with('success', 'Payout deleted');
    }
}
