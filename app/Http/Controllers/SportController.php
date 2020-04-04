<?php

namespace App\Http\Controllers;

use App\Sport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = DB::select("SELECT * FROM sports");
        return view('sports.index')->with('sports', $query);
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

        DB::insert("INSERT INTO sports (`name`, created_at, updated_at) VALUES (?, NOW(), NOW())", [
            $request->input('name')
        ]);

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
        $query = DB::select("SELECT * FROM sports WHERE id = ?", [$sport->id])[0];
        return view('sports.edit')->with('sport', compact('query')['query']);
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

        $query = DB::update("UPDATE sports SET `name` = ? WHERE id = ?", [
            $request->input('name'),
            $sport->id
            ]);

        return redirect('/sports')->with('success', "Sport updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sport  $sport
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sport $sport)
    {
        DB::delete("DELETE FROM sports WHERE id = ?", [$sport->id]);
        return redirect('/sports')->with('success', 'Sport deleted');
    }

    public function delete($id)
    {
        DB::delete("DELETE FROM sports WHERE id = ?", [$id]);
        return redirect('/sports')->with('success', 'Sport deleted');
    }
}
