<?php

namespace App\Http\Controllers;

use App\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CityController extends Controller
{

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
        $query = DB::select("SELECT * FROM cities");
        return view('cities.index')->with('cities', $query);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cities.create');
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

        DB::insert("INSERT INTO cities (`name`, created_at, updated_at) VALUES (?, NOW(), NOW())", [
            $request->input('name')
        ]);

        return redirect('/cities')->with('success', "City created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        $query = DB::select("SELECT * FROM cities WHERE id = ?", [$city->id])[0];
        return view('cities.edit')->with('city', compact('query')['query']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        $this->validate($request, [
            'name' => ['required']
        ]);

        $query = DB::update("UPDATE cities SET `name` = ? WHERE id = ?", [
            $request->input('name'),
            $city->id
            ]);

        return redirect('/cities')->with('success', "City updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        DB::delete("DELETE FROM cities WHERE id = ?", [$city->id]);
        return redirect('/cities')->with('success', 'City deleted');
    }

    public function delete($id)
    {
        DB::delete("DELETE FROM cities WHERE id = ?", [$id]);
        return redirect('/cities')->with('success', 'City deleted');
    }


    public function getSports(Request $request){

        $search = $request->search;
  
        if($search == '')
        {
           //$users = User::orderby('name','asc')->select('id','name')->limit(5)->get();
           $cities = DB::select('SELECT id, `name` FROM cities ORDER BY `name` ASC LIMIT 5');
        }
        else
        {
           //$users = User::orderby('name','asc')->select('id','name')->where('name', 'like', '%' .$search . '%')->limit(5)->get();
           $cities = DB::select("SELECT id, `name` FROM cities WHERE `name` LIKE ? ORDER BY `name` ASC LIMIT 5", ['%' . $search . '%']);
        }
  
        $response = array();
        foreach($cities as $city)
        {
           $response[] = ["value" => $city->id, "label" => $city->name];
        }
  
        echo json_encode($response);
        exit;
     }
}
