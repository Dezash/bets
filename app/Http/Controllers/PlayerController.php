<?php

namespace App\Http\Controllers;

use App\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = DB::select("SELECT players.*, teams.name AS team_name FROM players INNER JOIN teams ON players.team_id = teams.id");
        return view('players.index')->with('players', $query);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('players.create');
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
            'team_id' => ['required', 'numeric'],
            'first_name' => ['required'],
            'last_name' => ['required'],
            'country' => ['required']
        ]);
    
        DB::insert("INSERT INTO players (team_id, first_name, last_name, country, created_at, updated_at) VALUES (?, ?, ?, ?, NOW(), NOW())", [
            $request->input('team_id'),
            $request->input('first_name'),
            $request->input('last_name'),
            $request->input('country')
        ]);

        return redirect('/players')->with('success', "Player created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function show(Player $player)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function edit(Player $player)
    {
        $query = DB::select("SELECT players.*, teams.name AS team_name FROM players INNER JOIN teams ON players.team_id = teams.id WHERE players.id = ?", [$player->id])[0];
        return view('players.edit')->with('player', compact('query')['query']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Player $player)
    {
        $this->validate($request, [
            'team_id' => ['required'],
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'country' => ['required', 'string']
        ]);

        $query = DB::update("UPDATE players SET team_id = ?, first_name = ?, last_name = ?, country = ? WHERE id = ?", [
            $request->input('team_id'),
            $request->input('first_name'),
            $request->input('last_name'),
            $request->input('country'),
            $player->id
            ]);

        return redirect('/players')->with('success', "Player updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function destroy(Player $player)
    {
        DB::delete("DELETE FROM players WHERE id = ?", [$player->id]);
        return redirect('/players')->with('success', 'Player deleted');
    }

    public function delete($id)
    {
        DB::delete("DELETE FROM players WHERE id = ?", [$id]);
        return redirect('/players')->with('success', 'Player deleted');
    }
}
