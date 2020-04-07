<?php

namespace App\Http\Controllers;

use App\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
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
        $query = DB::select("SELECT shops.*, cities.name AS city_name FROM shops INNER JOIN cities ON cities.id = shops.city_id");
        return view('shops.index')->with('shops', $query);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('shops.create');
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
            'city_id' => ['required'],
            'address' => ['required'],
            'phone' => ['required'],
            'email' => ['required'],
            'opening_time' => ['required'],
            'closing_time' => ['required'],
            'department_id' => ['numeric']
        ]);

        DB::insert("INSERT INTO shops (city_id, `address`, phone, email, opening_time, closing_time, department, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), NOW())", [
            $request->input('city_id'),
            $request->input('address'),
            $request->input('phone'),
            $request->input('email'),
            $request->input('opening_time'),
            $request->input('closing_time'),
            $request->input('department_id')
        ]);

        return redirect('/shops')->with('success', "Shop created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function show(Shop $shop)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function edit(Shop $shop)
    {
        $query = DB::select("SELECT shops.*, cities.name AS city_name FROM shops INNER JOIN cities ON shops.city_id = cities.id WHERE shops.id = ?", [$shop->id])[0];
        $department_address = '';
        if (isset($query->department))
        {
            $query2 = DB::select("SELECT `address` FROM shops WHERE id = ?", [$shop->department])[0];
            $department_address = $query2->address;
        }
        
        return view('shops.edit')->with('shop', compact('query')['query'])->with('department_address', $department_address);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shop $shop)
    {
        $this->validate($request, [
            'city_id' => ['required', 'numeric'],
            'address' => ['required'],
            'phone' => ['required'],
            'email' => ['required'],
            'opening_time' => ['required'],
            'closing_time' => ['required'],
            'department_id' => ['numeric']
        ]);

        $query = DB::update("UPDATE shops SET city_id = ?, `address` = ?, phone = ?, email = ?, opening_time = ?, closing_time = ?, department = ? WHERE id = ?", [
            $request->input('city_id'),
            $request->input('address'),
            $request->input('phone'),
            $request->input('email'),
            $request->input('opening_time'),
            $request->input('closing_time'),
            $request->input('department_id'),
            $shop->id
            ]);

        return redirect('/shops')->with('success', "Shop updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop)
    {
        DB::delete("DELETE FROM shops WHERE id = ?", [$shop->id]);
        return redirect('/shops')->with('success', 'Shop deleted');
    }

    public function delete($id)
    {
        DB::delete("DELETE FROM shops WHERE id = ?", [$id]);
        return redirect('/shops')->with('success', 'Shop deleted');
    }


    public function getShops(Request $request){

        $search = $request->search;
  
        if($search == '')
        {
           //$users = User::orderby('name','asc')->select('id','name')->limit(5)->get();
           $shops = DB::select('SELECT id, `address` FROM shops ORDER BY `address` ASC LIMIT 5');
        }
        else
        {
           //$users = User::orderby('name','asc')->select('id','name')->where('name', 'like', '%' .$search . '%')->limit(5)->get();
           $shops = DB::select("SELECT id, `address` FROM shops WHERE `address` LIKE ? ORDER BY `address` ASC LIMIT 5", ['%' . $search . '%']);
        }
  
        $response = array();
        foreach($shops as $shop)
        {
           $response[] = ["value" => $shop->id, "label" => $shop->address];
        }
  
        echo json_encode($response);
        exit;
     }
}
