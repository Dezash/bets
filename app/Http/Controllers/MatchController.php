<?php

namespace App\Http\Controllers;

use App\Match;
use App\Team;
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
        $matches = Match::select("matches.*", "f_t.name AS first_team_name", "s_t.name AS second_team_name")->join("teams AS f_t", "f_t.id", "=", "first_team")->join("teams AS s_t", "s_t.id", "=", "second_team")->get();
        foreach($matches as $team)
        {
            if (isset($team->winning_team))
            {
                $team->winning_team_name = Team::select('name')->where('id', $team->winning_team)->get()[0]->name;
            }
        }

        return view('matches.index')->with('matches', $matches);
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

        Match::create($request->all());

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
        $obMatch = Match::select('matches.*', 'f_t.name AS first_team_name', 's_t.name AS second_team_name')->join('teams AS f_t', 'f_t.id', '=', 'first_team')->join('teams AS s_t', 's_t.id', '=', 'second_team')->where('matches.id', $match->id)->first();

        return view('matches.edit')->with('match', $obMatch);
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

        $bSuccess = $match->update($request->all());

        return redirect('/matches')->with($bSuccess ? 'success' : 'error', $bSuccess ? 'Match updated' : 'Error while updating the match');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Match  $match
     * @return \Illuminate\Http\Response
     */
    public function destroy(Match $match)
    {
        $match->delete();
        return redirect('/matches')->with('success', 'Match deleted');
    }

    public function delete($id)
    {
        Match::destroy($id);
        return redirect('/matches')->with('success', 'Match deleted');
    }

    public function getMatches(Request $request){

        $search = $request->search;
  
        if($search == '')
        {
           $matches = Match::select('id', 'name')->orderBy('name')->limit(5)->get();
        }
        else
        {
           $matches = Match::select('id', 'name')->where('name', 'like', '%' . $search . '%')->orderBy('name')->limit(5)->get();
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
