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

    public function report()
    {
        return view('bets.report');
    }

    public function getReport(Request $request)
    {
        $this->validate($request, [
            'date_from' => ['required', 'date'],
            'date_to' => ['required', 'date'],
        ]);

        $query = DB::select("SELECT
        users.id,
        bets.id AS bet_id,
        bets.created_at,
        CAST(bets.created_at AS DATE) AS `date`,
        users.first_name,
        users.last_name,
        bets.bet_sum,
    
        t.total_bet_sum,
        t.team_name,
        IFNULL(t.max_bet, 0) AS max_bet,
        IFNULL(t.avg_bet, 0) AS avg_bet,
        IFNULL(s.total_lost, 0) AS total_lost,
        IFNULL(v.total_paid, 0) AS total_paid
    FROM
      bets
      INNER JOIN users ON users.id = bets.user_id
      LEFT JOIN matches ON matches.id = bets.match_id
      LEFT JOIN (
        SELECT
          bets.user_id,
          teams.name AS team_name,
          SUM(bets.bet_sum) AS total_bet_sum,
          MAX(bets.bet_sum) AS max_bet,
          ROUND(AVG(bets.bet_sum), 2) as avg_bet
        FROM
          bets
          INNER JOIN users ON users.id = bets.user_id
          INNER JOIN teams ON teams.id = bets.team_id
        WHERE
          bets.created_at >= ?
          AND bets.created_at <= ?
        GROUP BY
          bets.user_id
      ) t ON t.user_id = users.id
      LEFT JOIN (
        SELECT
          bets.user_id,
          IFNULL(SUM(bets.bet_sum), 0) as total_lost
        FROM
          bets
          INNER JOIN users ON bets.user_id = users.id
          LEFT JOIN matches ON matches.id = bets.match_id
        WHERE
          bets.created_at >= ?
          AND bets.created_at <= ?
          AND matches.winning_team != bets.team_id
        GROUP BY
          bets.user_id
      ) s ON s.user_id = users.id
      LEFT JOIN (
        SELECT
          payouts.user_id,
          IFNULL(SUM(payouts.sum), 0) as total_paid
        FROM
          payouts
          INNER JOIN users ON payouts.user_id = users.id
        WHERE
          payouts.created_at >= ?
          AND payouts.created_at <= ?
        GROUP BY
          payouts.user_id
      ) v ON v.user_id = users.id
    WHERE
          bets.created_at >= ?
          AND bets.created_at <= ?
          AND users.id = IFNULL(?, users.id)
    GROUP BY
      bets.id
    ORDER BY
      users.last_name, created_at
    ", 
        [
            $request->input('date_from'),
            $request->input('date_to'),
            $request->input('date_from'),
            $request->input('date_to'),
            $request->input('date_from'),
            $request->input('date_to'),
            $request->input('date_from'),
            $request->input('date_to'),
            $request->input('user_id')
        ]);
        //dd($query);
        return view('bets.report')->with('reports', $query);
    }
}
