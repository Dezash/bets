<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Player;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Team::class, 'team');
    }
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('teams.index')->with('teams', Team::paginate(15));
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
        $rules = [
            'name' => ['required'],
            'league_id' => ['required', 'numeric'],
        ];

        foreach($request->first_name as $key => $value){
            $rules["first_name.{$key}"] = 'required';
            $rules["last_name.{$key}"] = 'required';
            $rules["country.{$key}"] = 'required';
        }

        $this->validate($request, $rules);

        $team = Team::create($request->all());

        foreach($request->first_name as $key => $value){
            Player::create([
                'team_id' => $team->id,
                'first_name' => $value,
                'last_name' => $request->last_name[$key],
                'country' => $request->country[$key]
            ]);

        }

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
        return view('teams.edit')->with('team', $team);
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

        $bSuccess = $team->update($request->all());
        return redirect('/teams')->with($bSuccess ? 'success' : 'error', $bSuccess ? 'Team updated' : 'Failed to update team');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        $team->delete();
        return redirect('/teams')->with('success', 'Team deleted');
    }

    public function delete($id)
    {
        Team::destroy($id);
        return redirect('/teams')->with('success', 'Team deleted');
    }


    public function getTeams(Request $request){

        $search = $request->search;
  
        if($search == '')
        {
            $teams = Team::select('id', 'name')->orderBy('name')->limit(5)->get();
        }
        else
        {
            $teams = Team::select('id', 'name')->where('name', 'like', '%' . $search . '%')->orderBy('name')->limit(5)->get();
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
