<?php

namespace App\Http\Controllers;

use App\Payout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PayoutsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = DB::select("SELECT payouts.*, users.name AS user_name FROM payouts INNER JOIN users ON payouts.user_id = users.id");
        /*$pdo = DB::connection()->getPdo()->prepare("SELECT payouts.*, users.name AS user_name FROM payouts INNER JOIN users ON payouts.id = users.id");
        $pdo->execute();
        $data = $sth->fetchAll(\PDO::FETCH_OBJ);
        return view('payouts.index')->with('payouts', $data);*/
        return view('payouts.index')->with('payouts', $query);
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
    
        DB::insert("INSERT INTO payouts (user_id, sum, fee, bank_account, payout_date, created_at, updated_at) VALUES (?, ?, ?, ?, NOW(), NOW(), NOW())", [
            $request->input('user_id'),
            $request->input('sum'),
            $request->input('fee'),
            $request->input('bank_account')
        ]);

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
        $query = DB::select("SELECT payouts.*, users.name AS user_name FROM payouts INNER JOIN users ON payouts.user_id = users.id WHERE payouts.id = ?", [$payout->id])[0];
        return view('payouts.edit')->with('payout', compact('query')['query']);
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

        $query = DB::update("UPDATE payouts SET user_id = ?, sum = ?, fee = ?, bank_account = ?, payout_date = ? WHERE id = ?", [
            $request->input('user_id'),
            $request->input('sum'),
            $request->input('fee'),
            $request->input('bank_account'),
            $request->input('payout_date'),
            $payout->id
            ]);

        return redirect('/payouts')->with('success', "Payout updated");
    }

    public function destroy($id)
    {
        DB::delete("DELETE FROM payouts WHERE id = ?", [$id]);
        return redirect('/payouts')->with('success', 'Payout deleted');
    }

    public function delete($id)
    {
        DB::delete("DELETE FROM payouts WHERE id = ?", [$id]);
        return redirect('/payouts')->with('success', 'Payout deleted');
    }
}
