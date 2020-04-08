<?php

namespace App\Http\Controllers;

use App\Match;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MatchController extends Controller
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
        $query = DB::select("SELECT matches.*, f_t.name AS first_team_name, s_t.name AS second_team_name FROM matches JOIN teams f_t ON f_t.id = first_team JOIN teams s_t ON s_t.id = second_team");
        foreach($query as $team)
        {
            if (isset($team->winning_team))
            {
                $team->winning_team_name = DB::select('SELECT `name` FROM teams WHERE id = ?', [$team->winning_team])[0]->name;
            }
        }

        return view('matches.index')->with('matches', $query);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('matches.create');
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
            'match_start' => ['required'],
            'match_end' => ['required'],
            'first_team' => ['required', 'numeric'],
            'second_team' => ['required', 'numeric']
        ]);

        DB::insert("INSERT INTO matches (match_start, match_end, first_team, second_team, first_team_score, second_team_score, created_at, updated_at) VALUES (?, ?, ?, ?, 0, 0, NOW(), NOW())", [
            $request->input('match_start'),
            $request->input('match_end'),
            $request->input('first_team'),
            $request->input('second_team')
        ]);

        return redirect('/matches')->with('success', "Match created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Match  $match
     * @return \Illuminate\Http\Response
     */
    public function show(Match $match)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Match  $match
     * @return \Illuminate\Http\Response
     */
    public function edit(Match $match)
    {
        $query = DB::select("SELECT matches.*, f_t.name AS first_team_name, s_t.name AS second_team_name FROM matches JOIN teams f_t ON f_t.id = first_team JOIN teams s_t ON s_t.id = second_team WHERE matches.id = ?", [$match->id]);

        return view('matches.edit')->with('match', $query[0]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Match  $match
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Match $match)
    {
        $this->validate($request, [
            'match_start' => ['required'],
            'match_end' => ['required'],
            'first_team' => ['required', 'numeric'],
            'second_team' => ['required', 'numeric'],
            'first_team_score' => ['required', 'numeric'],
            'second_team_score' => ['required', 'numeric']
        ]);

        $query = DB::update("UPDATE matches SET match_start = ?, match_end = ?, first_team = ?, second_team = ?, first_team_score = ?, second_team_score = ? WHERE id = ?", [
            $request->input('match_start'),
            $request->input('match_end'),
            $request->input('first_team'),
            $request->input('second_team'),
            $request->input('first_team_score'),
            $request->input('second_team_score'),
            $match->id
            ]);

        return redirect('/matches')->with('success', "Match updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Match  $match
     * @return \Illuminate\Http\Response
     */
    public function destroy(Match $match)
    {
        DB::delete("DELETE FROM matches WHERE id = ?", [$match->id]);
        return redirect('/matches')->with('success', 'Match deleted');
    }

    public function delete($id)
    {
        DB::delete("DELETE FROM matches WHERE id = ?", [$id]);
        return redirect('/matches')->with('success', 'Match deleted');
    }

    public function getMatches(Request $request){

        $search = $request->search;
  
        if($search == '')
        {
           //$users = User::orderby('name','asc')->select('id','name')->limit(5)->get();
           $matches = DB::select('SELECT id, `name` FROM matches ORDER BY `name` ASC LIMIT 5');
        }
        else
        {
           //$users = User::orderby('name','asc')->select('id','name')->where('name', 'like', '%' .$search . '%')->limit(5)->get();
           $matches = DB::select("SELECT id, `name` FROM matches WHERE `name` LIKE ? ORDER BY `name` ASC LIMIT 5", ['%' . $search . '%']);
        }
  
        $response = array();
        foreach($matches as $match)
        {
           $response[] = ["value" => $match->id, "label" => $match->name];
        }
  
        echo json_encode($response);
        exit;
     }
}
