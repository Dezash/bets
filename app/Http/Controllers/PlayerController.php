<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Player::class, 'player');
    }
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $players = Player::paginate(15);
        return view('players.index')->with('players', $players);
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
        
        Player::create($request->all());
    
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
        return view('players.edit')->with('player', $player);
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

        $bSuccess = $player->update($request->all());

        return redirect('/players')->with($bSuccess ? 'success' : 'error', $bSuccess ? 'Player updated' : 'Failed to update player');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function destroy(Player $player)
    {
        $player->delete();
        return redirect('/players')->with('success', 'Player deleted');
    }

    public function delete($id)
    {
        Player::destroy($id);
        return redirect('/players')->with('success', 'Player deleted');
    }
}
