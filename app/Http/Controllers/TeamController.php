<?php

namespace App\Http\Controllers;

use App\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeamController extends Controller
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
        $query = DB::select("SELECT teams.*, leagues.name AS league_name FROM teams INNER JOIN leagues ON teams.league_id = leagues.id");
        return view('teams.index')->with('teams', $query);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teams.create');
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
            'league_id' => ['required', 'numeric'],
        ]);

        DB::insert("INSERT INTO teams (`name`, league_id, created_at, updated_at) VALUES (?, ?, NOW(), NOW())", [
            $request->input('name'),
            $request->input('league_id')
        ]);

        return redirect('/teams')->with('success', "Team created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        $query = DB::select("SELECT teams.*, leagues.name AS league_name FROM teams INNER JOIN leagues ON teams.league_id = leagues.id WHERE teams.id = ?", [$team->id])[0];
        return view('teams.edit')->with('team', compact('query')['query']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        $this->validate($request, [
            'name' => ['required'],
            'league_id' => ['required', 'numeric']
        ]);

        $query = DB::update("UPDATE teams SET `name` = ?, league_id = ? WHERE id = ?", [
            $request->input('name'),
            $request->input('league_id'),
            $team->id
            ]);

        return redirect('/teams')->with('success', "Team updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        DB::delete("DELETE FROM teams WHERE id = ?", [$team->id]);
        return redirect('/teams')->with('success', 'Team deleted');
    }

    public function delete($id)
    {
        DB::delete("DELETE FROM teams WHERE id = ?", [$id]);
        return redirect('/teams')->with('success', 'Team deleted');
    }


    public function getTeams(Request $request){

        $search = $request->search;
  
        if($search == '')
        {
           //$users = User::orderby('name','asc')->select('id','name')->limit(5)->get();
           $teams = DB::select('SELECT id, `name` FROM teams ORDER BY `name` ASC LIMIT 5');
        }
        else
        {
           //$users = User::orderby('name','asc')->select('id','name')->where('name', 'like', '%' .$search . '%')->limit(5)->get();
           $teams = DB::select("SELECT id, `name` FROM teams WHERE `name` LIKE ? ORDER BY `name` ASC LIMIT 5", ['%' . $search . '%']);
        }
  
        $response = array();
        foreach($teams as $team)
        {
           $response[] = ["value" => $team->id, "label" => $team->name];
        }
  
        echo json_encode($response);
        exit;
     }
}
