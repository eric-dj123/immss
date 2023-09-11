<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Item;
use App\Models\main_stock_balance;
use App\Models\Purchase;
use App\Models\supplier;
use DB;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = supplier::all();
        $items = Item::orderBy('item_id', 'desc')->get();
        $item_arr = [];
        $cost_arr = [];

        return view('admin.purchase.index', compact('suppliers','items'))->with('item_arr', $item_arr)->with('cost_arr', $cost_arr);
    }
    public  function list()
    {
        $purch = new Purchase();
        $purchases = $purch->getPurchaseTotalsByCode();
        // dd($purchases);
        return view('admin.purchase.list', compact('purchases'));
    }
    public  function stock()
    {
        $items = main_stock_balance::all();
        // dd($purchases);
        return view('admin.purchase.stock', compact('items'));
    }
    public  function report()
    {
        $purch = new Purchase();
        $purchases = $purch->getPurchaseTotalsByCode();
        // dd($purchases);
        return view('admin.purchase.report', compact('purchases'));
    }
    public function view(string $id)
    {
        $purchases = Purchase::where('code', $id)->get();
        $purchase_1 = Purchase::where('code', $id)->get()->first();
        //if no order found redirect to index page
        if (!$purchases || !$purchase_1) {
            return redirect()->back()->with('error', 'Purchase Not Found');
        }
        $suppliers = supplier::all();
        $supplier = supplier::where('id', $purchase_1->supplier_id)->get()->first();
        return view('admin.purchase.view', compact('purchases', 'purchase_1','suppliers','supplier'));
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
        //
        // dd($request);
        $req = $request->all();
        //loop throu items selected
        //generate unique purchase code with PU prefix and 6 digit random number based on tme
        $purchase_code = 'PU' . date('ymdhis') . rand(100000, 999999);
        for ($i = 0; $i < count($req['item_id']); $i++) {
            $purchase = new Purchase();
            $purchase->code = $purchase_code;
            $purchase->item_id = $req['item_id'][$i];
            $purchase->supplier_id = $req['supplier_id'];
            $purchase->quantity = $req['qty'][$i];
            $purchase->total = $req['total'][$i];
            $purchase->save();
        }
        return redirect()->route('admin.purchase.list')->with('success', 'Purchase Order Created Successfully');
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
        //validate request and sub array
        $request->validate([
            'purcha_id' => 'required|array',
            'purcha_id.*' => 'required|integer',
            'qty' => 'required|array',
            'qty.*' => 'required|integer',
            'total' => 'required|array',
            'total.*' => 'required|integer',
        ]);

        $req = $request->all();
        for ($i = 0; $i < count($req['purcha_id']); $i++) {
            $order = Purchase::find($req['purcha_id'][$i]);
            $order->total = $req['total'][$i];
            $order->quantity = $req['qty'][$i];
            $order->save();
        }
        return redirect()->route('admin.purchase.list')->with('success', 'Purchase Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
