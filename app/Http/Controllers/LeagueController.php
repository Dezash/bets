<?php

namespace App\Http\Controllers;

use App\League;
use App\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeagueController extends Controller
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
        $leagues = League::select("leagues.*", "sports.name AS sport_name")->join("sports", "leagues.sport_id", "=", "sports.id")->get();
        return view('leagues.index')->with('leagues', $leagues);
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
        $rules = [
            'name' => ['required'],
            'wins' => ['required', 'numeric'],
            'losses' => ['required', 'numeric'],
            'ties' => ['required', 'numeric'],
            'sport_id' => ['required', 'numeric']
        ];


        if(isset($request->teamname))
        {
            foreach($request->teamname as $key => $value){
                $rules["teamname.{$key}"] = 'required';
            }
        }

        $this->validate($request, $rules);

        $league = League::create($request->all());

        if(isset($request->teamname))
        {
            foreach($request->teamname as $key => $value){
                Team::create([
                    'league_id' => $league->league_id,
                    'name' => $value
                ]);
            }
        }

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
        $league = League::select("leagues.*", "sports.name AS sport_name")->join("sports", "leagues.sport_id", "=", "sports.id")->where("leagues.id", $league->id)->first();
        return view('leagues.edit')->with('league', $league);
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

        $league->update($request->all());

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
        $league->delete();
        return redirect('/leagues')->with('success', 'League deleted');
    }

    public function delete($id)
    {
        League::destroy($id);
        return redirect('/leagues')->with('success', 'League deleted');
    }


    public function getLeagues(Request $request){

        $search = $request->search;
  
        if($search == '')
        {
            $leagues = League::orderBy('name')->limit(5)->get();
        }
        else
        {
           $leagues = League::where('name', 'like', '%' . $search . '%')->orderBy('name')->limit(5)->get();
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
