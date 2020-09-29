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
        return view('receipts.index')->with('receipts', Receipt::all());
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

        $request->paid = $request->paid == 1 ? 1 : 0;

        Receipt::create($request->all());

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
        return view('receipts.edit')->with('receipt', $receipt);
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

        $bSuccess = $receipt->update();
        return redirect('/receipts')->with($bSuccess ? 'success' : 'error', $bSuccess ? 'Receipt updated' : 'Failed to update receipt');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receipt $receipt)
    {
        $receipt->delete();
        return redirect('/receipts')->with('success', 'Receipt deleted');
    }

    public function delete($id)
    {
        Receipt::destroy($id);
        return redirect('/receipts')->with('success', 'Receipt deleted');
    }
}
