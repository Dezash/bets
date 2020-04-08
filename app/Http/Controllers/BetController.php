<?php

namespace App\Http\Controllers;

use App\Bet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BetController extends Controller
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
        $query = DB::select("SELECT bets.*, teams.name AS team_name, users.name AS user_name FROM bets INNER JOIN teams ON teams.id = bets.team_id INNER JOIN users ON users.id = bets.user_id");
        return view('bets.index')->with('bets', $query);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bets.create');
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
            'match_id' => ['required', 'numeric'],
            'receipt_id' => ['required', 'numeric'],
            'team_id' => ['required', 'numeric'],
            'user_id' => ['required', 'numeric'],
            'bet_sum' => ['required', 'numeric']
        ]);

        DB::insert("INSERT INTO bets (match_id, receipt_id, team_id, user_id, bet_sum, created_at, updated_at) VALUES (?, ?, ?, ?, ?, NOW(), NOW())", [
            $request->input('match_id'),
            $request->input('receipt_id'),
            $request->input('team_id'),
            $request->input('user_id'),
            $request->input('bet_sum')
        ]);

        return redirect('/bets')->with('success', "Bet created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bet  $bet
     * @return \Illuminate\Http\Response
     */
    public function show(Bet $bet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bet  $bet
     * @return \Illuminate\Http\Response
     */
    public function edit(Bet $bet)
    {
        $query = DB::select("SELECT bets.*, teams.name AS team_name, users.name AS user_name FROM bets INNER JOIN teams ON teams.id = bets.team_id INNER JOIN users ON users.id = bets.user_id WHERE bets.id = ?", [$bet->id]);
        return view('bets.edit')->with('bet', $query[0]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bet  $bet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bet $bet)
    {
        $this->validate($request, [
            'match_id' => ['required', 'numeric'],
            'receipt_id' => ['required', 'numeric'],
            'team_id' => ['required', 'numeric'],
            'user_id' => ['required', 'numeric'],
            'bet_sum' => ['required', 'numeric']
        ]);

        $query = DB::update("UPDATE bets SET match_id = ?, receipt_id = ?, team_id = ?, user_id = ?, bet_sum = ? WHERE id = ?", [
            $request->input('match_id'),
            $request->input('receipt_id'),
            $request->input('team_id'),
            $request->input('user_id'),
            $request->input('bet_sum'),
            $bet->id
            ]);

        return redirect('/bets')->with('success', "Bet updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bet  $bet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bet $bet)
    {
        DB::delete("DELETE FROM bets WHERE id = ?", [$bet->id]);
        return redirect('/bets')->with('success', 'Bet deleted');
    }

    public function delete($id)
    {
        DB::delete("DELETE FROM bets WHERE id = ?", [$id]);
        return redirect('/bets')->with('success', 'Bet deleted');
    }
}
