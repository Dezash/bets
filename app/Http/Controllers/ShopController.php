<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;

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
        return view('shops.index')->with('shops', Shop::all());
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

        Shop::create($request->all());

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
        return view('shops.edit')->with('shop', $shop);
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

        $shop->update($request->all());

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
        $shop->delete();
        return redirect('/shops')->with('success', 'Shop deleted');
    }

    public function delete($id)
    {
        Shop::destroy($id);
        return redirect('/shops')->with('success', 'Shop deleted');
    }


    public function getShops(Request $request){

        $search = $request->search;
  
        if($search == '')
        {
           $shops = Shop::select('id', 'address')->orderBy('address')->limit(5)->get();
        }
        else
        {
           $shops = Shop::select('id', 'address')->where('address', 'like', '%' . $search . '%')->orderBy('address')->limit(5)->get();
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
