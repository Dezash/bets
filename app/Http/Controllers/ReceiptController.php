<?php

namespace App\Http\Controllers;

use App\Receipt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReceiptController extends Controller
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
        $query = DB::select("SELECT * FROM receipts");
        return view('receipts.index')->with('receipts', $query);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('receipts.create');
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
            'sum' => ['required', 'numeric'],
            'date_paid' => ['required'],
        ]);

        DB::insert("INSERT INTO receipts (`sum`, paid, date_paid, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW())", [
            $request->input('sum'),
            $request->input('paid') == 1 ? 1 : 0,
            $request->input('date_paid')
        ]);

        return redirect('/receipts')->with('success', "Receipt created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function show(Receipt $receipt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function edit(Receipt $receipt)
    {
        $query = DB::select("SELECT * FROM receipts WHERE id = ?", [$receipt->id])[0];
        return view('receipts.edit')->with('receipt', compact('query')['query']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receipt $receipt)
    {
        $this->validate($request, [
            'sum' => ['required', 'numeric'],
            'date_paid' => ['required']
        ]);

        $query = DB::update("UPDATE receipts SET `sum` = ?, paid = ?, date_paid = ? WHERE id = ?", [
            $request->input('sum'),
            $request->input('paid') == 1 ? 1 : 0,
            $request->input('date_paid'),
            $receipt->id
            ]);

        return redirect('/receipts')->with('success', "Receipt updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receipt $receipt)
    {
        DB::delete("DELETE FROM receipts WHERE id = ?", [$receipt->id]);
        return redirect('/receipts')->with('success', 'Receipt deleted');
    }

    public function delete($id)
    {
        DB::delete("DELETE FROM receipts WHERE id = ?", [$id]);
        return redirect('/receipts')->with('success', 'Receipt deleted');
    }
}
