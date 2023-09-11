<?php

namespace App\Http\Controllers\Branch;

use App\Models\Country;
use App\Models\Outboxing;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\stock_branch_balance;
use Illuminate\Support\Facades\Auth;

class OutboxingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return dd(Country::country_tarif()->toSql());
        //
        $blanch = Auth::user()->branch;
        //model of stock_branch_balance;
        $items = stock_branch_balance::branch_balance([$blanch],"sell");
        // get outboxing records based on blanch
        $outboxings = Outboxing::where('blanch', $blanch)
        ->where('status','1')
        ->orderBy('out_id', 'desc')
        ->get();
        return view('branch.outboxing.index', compact('outboxings','items'));
    }
    public function index1()
    {
        // return dd(Country::country_tarif()->toSql());
        $count = DB::table('outboxing')->where('status', 1)->count();
        $bra = DB::table('branches')->where('id',auth()->user()->branch)->get();
        $blanch = Auth::user()->branch;
        //model of stock_branch_balance;
        $items = stock_branch_balance::branch_balance([$blanch],"sell");
        // get outboxing records based on blanch
        $inboxings = Outboxing::where('blanch', $blanch)
        ->orderBy('out_id', 'desc')
        ->get();
        return view('branch.outboxing.emsmailouttransfer', compact('inboxings','items','count','bra'));
    }
    public function view(string $id)
    {
        //
        $blanch = Auth::user()->branch;
        //model of stock_branch_balance;
        $items = stock_branch_balance::branch_balance([$blanch],"sell");
        // get outboxing records based on blanch
        $outbox = Outboxing::where([['blanch','=', $blanch],["out_id","=",$id]] )->get()->first();
        if(!$outbox){
            return redirect()->back()->with('error', 'Outboxing Record Not Found');
        }
        // return dd($outbox);
        return view('branch.outboxing.view', compact('outbox','items'));
    }
    public function history()
    {
        //
        $blanch = Auth::user()->branch;
        //model of stock_branch_balance;
        $items = stock_branch_balance::branch_balance([$blanch],"sell");
        // get outboxing records based on blanch
        return view('branch.outboxing.history', compact('items'));
    }
    public function report()
    {
        $courierPays = DB::table('outboxing')
        ->select(DB::raw('SUM(amount) as cash'), DB::raw('SUM(postage) as postage'), 'pdate')
        ->where('user_id', auth()->user()->id)
        ->groupBy('pdate')
        ->orderBy('pdate', 'DESC')
        ->limit(30)
        ->get();
    return view('branch.outboxing.report', compact('courierPays'));

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
        // validate the request to store in outboxing based on its $fillable
        $request->validate([
            'tracking' => 'required|string',
            'snames' => 'required|string',
            'sphone' => 'required|string',
            'semail' => 'required|string',
            'snid' => 'required|string',
            'saddress' => 'required|string',
            'rcountry' => 'required|string',
            'rnames' => 'required|string',
            'rphone' => 'required|string',
            'remail' => 'required|string',
            'raddress' => 'required|string',
            'weight' => 'required|numeric',
            'unit' => 'required|string',
            'amount' => 'required|numeric',
            'tax' => 'required|numeric',
            'item_id' => 'required|integer',
            'postage' => 'required|numeric',
            'ptype' => 'required|string',
        ]);
        // Get Branch Id
        $blanch = Auth::user()->branch;
        // get user id
        $user = Auth::user()->id;
        // return dd($user);
        //store request in db by atribute separately
        $outboxing = new Outboxing();
        $outboxing->user_id = $user;
        $outboxing->blanch = $blanch;
        $outboxing->tracking = $request->tracking;
        $outboxing->snames = $request->snames;
        $outboxing->sphone = $request->sphone;
        $outboxing->semail = $request->semail;
        $outboxing->snid = $request->snid;
        $outboxing->saddress = $request->saddress;
        $outboxing->c_id = $request->rcountry;
        $outboxing->rnames = $request->rnames;
        $outboxing->rphone = $request->rphone;
        $outboxing->remail = $request->remail;
        $outboxing->raddress = $request->raddress;
        $outboxing->weight = $request->weight;
        $outboxing->unit = $request->unit;
        $outboxing->amount = $request->amount;
        $outboxing->tax = $request->tax;
        $outboxing->item_id = $request->item_id;
        $outboxing->postage = $request->postage;
        $outboxing->ptype = $request->ptype;
        $outboxing->status = 1;
        // $outboxing->reference = $request->reference;
        $outboxing->save();
        // return with success message
        return redirect()->route('branch.outboxing.index')->with('success', 'EMS Mail Outboxing created successfully.');

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
        //
        // validate the request to store in outboxing based on its $fillable
        $request->validate([
            'tracking' => 'required|string',
            'snames' => 'required|string',
            'sphone' => 'required|string',
            'semail' => 'required|string',
            'snid' => 'required|string',
            'saddress' => 'required|string',
            'rcountry' => 'required|string',
            'rnames' => 'required|string',
            'rphone' => 'required|string',
            'remail' => 'required|string',
            'raddress' => 'required|string',
            'weight' => 'required|numeric',
            'unit' => 'required|string',
            'amount' => 'required|numeric',
            'tax' => 'required|numeric',
            'item_id' => 'required|integer',
            'postage' => 'required|numeric',
            'ptype' => 'required|string',
        ]);
        // Get Branch Id
        $blanch = Auth::user()->branch;
        // get user id
        $user = Auth::user()->id;
        // return dd($user);
        //store request in db by atribute separately
        $outboxing = Outboxing::findorfail($id);
        $outboxing->user_id = $user;
        if($outboxing->blanch != $blanch){
            return redirect()->back()->with('error', 'You are not allowed to edit this record');
        }
        $outboxing->blanch = $blanch;
        $outboxing->tracking = $request->tracking;
        $outboxing->snames = $request->snames;
        $outboxing->sphone = $request->sphone;
        $outboxing->semail = $request->semail;
        $outboxing->snid = $request->snid;
        $outboxing->saddress = $request->saddress;
        $outboxing->c_id = $request->rcountry;
        $outboxing->rnames = $request->rnames;
        $outboxing->rphone = $request->rphone;
        $outboxing->remail = $request->remail;
        $outboxing->raddress = $request->raddress;
        $outboxing->weight = $request->weight;
        $outboxing->unit = $request->unit;
        $outboxing->amount = $request->amount;
        $outboxing->tax = $request->tax;
        $outboxing->item_id = $request->item_id;
        $outboxing->postage = $request->postage;
        $outboxing->ptype = $request->ptype;
        $outboxing->status = 1;
        // $outboxing->reference = $request->reference;
        $outboxing->save();
        // return with success message
        return redirect()->route('branch.outboxing.index')->with('success', 'EMS Mail Outboxing Updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Outboxing::findorfail($id)->delete();
        return redirect()->back()->with('success', 'EMS Mail Outboxing Record deleted successfully');
    }
    public function invoiceems($out_id)
    {
        $outbox = Outboxing::where('out_id',$out_id)->get()->first();






        $pdf = Pdf::loadView('branch.outboxing.emsinvoice', compact('outbox','out_id'))
        ->setPaper('a5', 'portrait');
        // Set the font size to 10px
        $font = [
            'size' => 1,
        ];

        $pdf->getDomPDF()->getOptions()->set('font-size', $font);
        return $pdf->stream('emsinvoice.pdf');

        return view('branch.outboxing.emsinvoice', compact('outbox','out_id'));
    }

    public function transactionouems($pdate)
    {
        $inboxings = DB::table('outboxing')
        ->select('outboxing.*')
        ->where('outboxing.pdate',$pdate)
        ->where('outboxing.user_id',auth()->user()->id)
        ->get();

        $pdf = Pdf::loadView('branch.outboxing.emstransaction', compact('pdate','inboxings'))
        ->setPaper('a4', 'portrait');
        return $pdf->stream('transactionoutboxingems.pdf');
    }
}
