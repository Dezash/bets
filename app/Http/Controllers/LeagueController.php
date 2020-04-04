<?php

namespace App\Http\Controllers;

use App\League;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeagueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = DB::select("SELECT leagues.*, sports.name AS sport_name FROM leagues INNER JOIN sports ON leagues.sport_id = sports.id");
        return view('leagues.index')->with('leagues', $query);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('leagues.create');
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
            'name' => ['required'],
            'wins' => ['required', 'numeric'],
            'losses' => ['required', 'numeric'],
            'ties' => ['required', 'numeric'],
            'sport_id' => ['required', 'numeric'],
        ]);

        DB::insert("INSERT INTO leagues (`name`, wins, losses, ties, sport_id, created_at, updated_at) VALUES (?, ?, ?, ?, ?, NOW(), NOW())", [
            $request->input('name'),
            $request->input('wins'),
            $request->input('losses'),
            $request->input('ties'),
            $request->input('sport_id')
        ]);

        return redirect('/leagues')->with('success', "League created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\League  $league
     * @return \Illuminate\Http\Response
     */
    public function show(League $league)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\League  $league
     * @return \Illuminate\Http\Response
     */
    public function edit(League $league)
    {
        $query = DB::select("SELECT leagues.*, sports.name AS sport_name FROM leagues INNER JOIN sports ON leagues.sport_id = sports.id WHERE leagues.id = ?", [$league->id])[0];
        return view('leagues.edit')->with('league', compact('query')['query']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\League  $league
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, League $league)
    {
        $this->validate($request, [
            'name' => ['required'],
            'wins' => ['required', 'numeric'],
            'losses' => ['required', 'numeric'],
            'ties' => ['required', 'numeric'],
            'sport_id' => ['required', 'numeric']
        ]);

        $query = DB::update("UPDATE leagues SET `name` = ?, wins = ?, losses = ?, ties = ?, sport_id = ? WHERE id = ?", [
            $request->input('name'),
            $request->input('wins'),
            $request->input('losses'),
            $request->input('ties'),
            $request->input('sport_id'),
            $league->id
            ]);

        return redirect('/leagues')->with('success', "League updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\League  $league
     * @return \Illuminate\Http\Response
     */
    public function destroy(League $league)
    {
        DB::delete("DELETE FROM leagues WHERE id = ?", [$league->id]);
        return redirect('/leagues')->with('success', 'League deleted');
    }

    public function delete($id)
    {
        DB::delete("DELETE FROM leagues WHERE id = ?", [$id]);
        return redirect('/leagues')->with('success', 'League deleted');
    }


    public function getLeagues(Request $request){

        $search = $request->search;
  
        if($search == '')
        {
           //$users = User::orderby('name','asc')->select('id','name')->limit(5)->get();
           $leagues = DB::select('SELECT id, `name` FROM leagues ORDER BY `name` ASC LIMIT 5');
        }
        else
        {
           //$users = User::orderby('name','asc')->select('id','name')->where('name', 'like', '%' .$search . '%')->limit(5)->get();
           $leagues = DB::select("SELECT id, `name` FROM leagues WHERE `name` LIKE ? ORDER BY `name` ASC LIMIT 5", ['%' . $search . '%']);
        }
  
        $response = array();
        foreach($leagues as $league)
        {
           $response[] = ["value" => $league->id, "label" => $league->name];
        }
  
        echo json_encode($response);
        exit;
     }
}
