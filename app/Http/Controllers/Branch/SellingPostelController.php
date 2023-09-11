<?php

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use App\Models\posteloutboxing;
use App\Models\stock_branch_balance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellingPostelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blanch = Auth::user()->branch;
        //model of stock_branch_balance;
        $items = stock_branch_balance::branch_balance([$blanch],"sell");
        // get outboxing records based on blanch
        $outboxings = posteloutboxing::postel();
        return view('branch.sellingpostel.index', compact('outboxings','items'));
    }
    public function modify(string $id)
    {
        $blanch = Auth::user()->branch;
        //model of stock_branch_balance;
        $items = stock_branch_balance::branch_balance([$blanch],"sell");
        // get outboxing records based on blanch
        $outbox = posteloutboxing::find($id);
        return view('branch.sellingpostel.update', compact('outbox','items'));
    }    
    public function history()
    {
        $blanch = Auth::user()->branch;
        //model of stock_branch_balance;
        $items = stock_branch_balance::branch_balance([$blanch],"sell");
        // get outboxing records based on blanch
        return view('branch.sellingpostel.history', compact('items'));
    }
    public function report()
    {
        $blanch = Auth::user()->branch;
        //model of stock_branch_balance;
        $items = stock_branch_balance::branch_balance([$blanch],"sell");
        // get outboxing records based on blanch
        $year = date('Y'); // Replace with your desired year
        $outboxings = posteloutboxing::getMonthlySumData($year, $blanch);
        return view('branch.sellingpostel.report', compact('outboxings','items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate request
        $request->validate([
            'snames' => 'required|string',
            'sphone' => 'required|string',
            'saddress' => 'required|string',
            'item_id' => 'required|integer',
            'qty' => 'required|integer',
            'postage' => 'required|integer',
            'amount' => 'required|integer',
            'ptype' => 'required|string',
        ]);
        //get branch id
        $blanch = Auth::user()->branch;
        //get item id
        $item_id = $request->item_id;
        //get item quantity
        $qty = $request->qty;
        //save data to db using posteloutboxing model
        $posteloutboxing = new posteloutboxing();
        $posteloutboxing->snames = $request->snames;
        $posteloutboxing->sphone = $request->sphone;
        $posteloutboxing->saddress = $request->saddress;
        $itm = stock_branch_balance::branch_balance([$blanch,$item_id],"data");
        if ($qty > $itm->qty) {
            return redirect()->route('branch.sellingpostel.index')->with('error', 'Postel Quantity is more than available stock');
        }
        $posteloutboxing->item_id = $item_id;
        $posteloutboxing->qty = $qty;
        // $posteloutboxing->postage = $request->postage;
        $posteloutboxing->amount = $request->amount;
        $posteloutboxing->ptype = $request->ptype;
        $posteloutboxing->blanch = $blanch;
        $posteloutboxing->user_id = Auth::user()->id;
        $posteloutboxing->status = 1;
        $posteloutboxing->pt_reference = "postel-".time()."-".rand(1000,9999);
        $posteloutboxing->save();
        //update stock_branch_balance
        //message to user
        return redirect()->route('branch.sellingpostel.index')->with('success', 'Postel Sold Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //validate request
        $request->validate([
            'snames' => 'required|string',
            'sphone' => 'required|string',
            'saddress' => 'required|string',
            'item_id' => 'required|integer',
            'qty' => 'required|integer',
            'postage' => 'required|integer',
            'amount' => 'required|integer',
            'ptype' => 'required|string',
        ]);
        //get branch id
        $blanch = Auth::user()->branch;
        //get item id
        $item_id = $request->item_id;
        //get item quantity
        $qty = $request->qty;
        //save data to db using posteloutboxing model
        $posteloutboxing = posteloutboxing::findorfail($id);;
        $posteloutboxing->snames = $request->snames;
        $posteloutboxing->sphone = $request->sphone;
        $posteloutboxing->saddress = $request->saddress;
        $itm = stock_branch_balance::branch_balance([$blanch,$item_id],"data");
        if ($qty > ($itm->qty + $posteloutboxing->qty)) {
            return redirect()->route('branch.sellingpostel.index')->with('error', 'Postel Quantity is more than available stock');
        }
        $posteloutboxing->item_id = $item_id;
        $posteloutboxing->qty = $qty;
        // $posteloutboxing->postage = $request->postage;
        $posteloutboxing->amount = $request->amount;
        $posteloutboxing->ptype = $request->ptype;
        $posteloutboxing->blanch = $blanch;
        if($posteloutboxing->blanch != $blanch){
            return redirect()->back()->with('error', 'You are not allowed to edit this record');
        }
        $posteloutboxing->user_id = Auth::user()->id;
        $posteloutboxing->status = 1;
        // $posteloutboxing->pt_reference = "postel-".time()."-".rand(1000,9999);
        $posteloutboxing->save();
        //update stock_branch_balance
        //message to user
        return redirect()->route('branch.sellingpostel.index')->with('success', 'Postel updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //delete data
        posteloutboxing::findorfail($id)->delete();
        return redirect()->back()->with('success', 'Postel Record deleted successfully');
    }
}
