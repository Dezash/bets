<?php

namespace App\Http\Controllers;

use App\Models\Sport;
use Illuminate\Http\Request;

class SportController extends Controller
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
        return view('sports.index')->with('sports', Sport::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sports.create');
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
            'name' => ['required']
        ]);

        Sport::create($request->all());

        return redirect('/sports')->with('success', "Sport created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sport  $sport
     * @return \Illuminate\Http\Response
     */
    public function show(Sport $sport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sport  $sport
     * @return \Illuminate\Http\Response
     */
    public function edit(Sport $sport)
    {
        return view('sports.edit')->with('sport', $sport);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sport  $sport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sport $sport)
    {
        $this->validate($request, [
            'name' => ['required']
        ]);

        $bSuccess = $sport->update($request->all());

        return redirect('/sports')->with($bSuccess ? 'success' : 'error', $bSuccess ? 'Sport updated' : 'Error while updating sport');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sport  $sport
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sport $sport)
    {
        $sport->delete();
        return redirect('/sports')->with('success', 'Sport deleted');
    }

    public function delete($id)
    {
        Sport::destroy($id);
        return redirect('/sports')->with('success', 'Sport deleted');
    }


    public function getSports(Request $request){

        $search = $request->search;
  
        if($search == '')
        {
           $sports = Sport::select('id', 'name')->orderBy('name')->limit(5)->get();
        }
        else
        {
           $sports = Sport::select('id', 'name')->where('name', 'like', '%' . $search . '%')->orderBy('name')->limit(5)->get();
        }
  
        $response = array();
        foreach($sports as $sport)
        {
           $response[] = ["value" => $sport->id, "label" => $sport->name];
        }
  
        echo json_encode($response);
        exit;
     }
}
