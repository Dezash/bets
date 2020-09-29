<?php

namespace App\Http\Controllers;

use App\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
        $cities = City::all();
        return view('cities.index')->with('cities', $cities);
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

        City::create($request->all());

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
        $city = City::find($city->id);
        return view('cities.edit')->with('city', $city);
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

        $city->update($request->all());

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
        $city->delete();
        //DB::delete("DELETE FROM cities WHERE id = ?", [$city->id]);
        return redirect('/cities')->with('success', 'City deleted');
    }

    public function delete($id)
    {
        City::destroy($id);
        return redirect('/cities')->with('success', 'City deleted');
    }


    public function getCities(Request $request){

        $search = $request->search;
  
        if($search == '')
        {
            $cities = City::select("id", "name")->orderBy("name")->take(5);
        }
        else
        {
            $cities = City::select("id", "name")->where("name", "like", '%' . $search . '%')->orderBy("name")->take(5);
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
