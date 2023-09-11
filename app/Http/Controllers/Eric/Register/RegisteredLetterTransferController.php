<?php

namespace App\Http\Controllers\Eric\Register;

use App\Models\Box;
use App\Models\User;
use App\Models\Branch;
use Illuminate\Http\Request;
use App\Models\Eric\Inboxing;
use App\Models\Eric\Transfer;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Eric\Transferdatails;

class RegisteredLetterTransferController extends Controller
{
    public function index()
    {
        $branches = Branch::all();

        return view('admin.register.registeredlettertransfer', compact('branches'));
    }
    public function registertr($id){
        //$inboxings = Inboxing::where('location',$id)->where('instatus','0')->where('mailtype','ems')->get() ;
        //$boxes = Box::all();
       // $branches = Branch::all();
        //$bras = Branch::where('id',$id)->get();
        $count = Inboxing::where('mailtranserf',  '0')
                ->Where('mailtype',  'rl')
                ->Where('location',  decrypt($id))
                ->count();
        $employees = User::where('level',  'b')->get();

        $inboxings = Inboxing::where('mailtype','rl')
        ->where('mailtranserf','0')
        ->where('instatus','0')
        ->where('location',decrypt($id))->get();
        $bras = Branch::where('id',decrypt($id))->get();
        $results = Transfer::where('mailtype','rl')->where('touserid',decrypt($id))->get();
        return view('admin.register.registeredlettertransferformreg',compact('id','count','inboxings','employees','results','bras'));

    }
    public function storeletterreg(Request $request)
    {
        $formField = $request->validate([
            'mnumber' => 'required',
            'touserid' => 'required',
        ]);
    $totalpmt = Branch::where('id',$request->touserid)->sum('rlt');
    $mnumber = $request->mnumber;
    if($totalpmt<$mnumber){
        return back()->with('warning', 'Not Transfered Becouse number of Percel Transfer is Higher than Percel Transfer In Store.');
    }
    else{

     Branch::where('id',$request->touserid)->decrement('rlt',$request->mnumber);

     $transfer = Transfer::create([
        'fromuserid' => auth()->user()->id,
        'touserid' =>$request->touserid,
        'rvdate' => now(),
        'mailtype' => 'rl',
        'mnumber' =>$request->mnumber,
      ]);
    }

      return back()->with('success', 'Thank you to  Transf mail and mail tranferd Successufully .');

    }
    public function regletterapi($id,$user)
    {
        $results = Transfer::join('users', 'transfers.fromuserid', '=', 'users.id')
        ->join('branches', 'transfers.touserid', '=', 'branches.id')
        ->select('users.name as user_name', 'branches.name as branch_name','transfers.id as idd','transfers.mnumber as mnumb','transfers.created_at as dates')
        ->where('transfers.mailtype', 'rl')
        ->where('transfers.touserid', decrypt($id))
        ->orderBy('transfers.id', 'desc')
        ->get();
        // $inboxings = Inboxing::where('location',$id)->get();
        return response()->json([
            'data' => $results,
            'status' => 200,
        ]);
    }
    public function store(Request $request)
    {
        $formField = $request->validate([
            'inid' => 'required',
            'touserid' => 'required',
        ]);

    $transfer = Transfer::create([
        'fromuserid' => auth()->user()->id,
        'touserid' => decrypt($request->touserid),
        'rvdate' => now(),
        'mnumber' => count($request->inid),
        'mailtype' => 'rl',
      ]);
   $trnsId = $transfer->id;
      foreach ($request->inid as $key) {
        Transferdatails::create([
            'trid' => $trnsId,
            'inid' => $key,
        ]);
        $inboxing = Inboxing::findOrFail($key);

        // Update the fields with the new values
        $inboxing->update([
            'mailtranserf' => '1',
            'instatus' => '1',
            'transdate' => now(), // This will set the transdate field to the current date and time
        ]);
      }

      return back()->with('success', 'Thank you to  Transf mail and mail tranferd Successufully .');
    }
    public function invoicereg($idd)
    {
        $inboxings = DB::select("SELECT * FROM inboxings WHERE id IN (SELECT inid FROM transferdatails WHERE trid = ?)", [$idd]);
        $pdf = Pdf::loadView('admin.register.invoiceregisteredletter', compact('inboxings','idd'))
        ->setPaper('a4', 'portrait');
         return $pdf->stream('Registered LetterTransfer.pdf');
    }
}
