<?php

namespace App\Http\Controllers\Eric;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Branch;
use App\Models\Comment;
use App\Models\Outboxing;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Eric\TotalAllMails;
use Illuminate\Support\Facades\DB;
use App\Models\Eric\AirportDispach;
use App\Http\Controllers\Controller;

class CntpMailController extends Controller
{
    public function index()
    {

        $inboxings = AirportDispach::where('status','1')->orderBy('id', 'desc')->get();
        return view('admin.cntp.cntpmailincoming', compact('inboxings'));
    }
    public function index1()
    {

        $comments = Comment::all();
        $inboxings = AirportDispach::where('status','2')->where('dispachetype','Mails')->orderBy('id', 'desc')->get();

        return view('admin.cntp.cntpmailopening', compact('inboxings','comments'));
    }
    public function emsopen()
    {

        $comments = Comment::all();
        $inboxings = AirportDispach::where('status','2')->where('dispachetype','EMS')->orderBy('id', 'desc')->get();

        return view('admin.cntp.cntpemsopenings', compact('inboxings','comments'));
    }
    public function percelopen()
    {
        $comments = Comment::all();
        $inboxings = AirportDispach::where('status','2')->where('dispachetype','PERCEL')->orderBy('id', 'desc')->get();
        return view('admin.cntp.cntppercelopen', compact('inboxings','comments'));
    }
    public function regopen()
    {
        $comments = Comment::all();
        $inboxings = AirportDispach::where('status','2')->wherein('regstatus',[1,2])->where('dispachetype','Mails')->orderBy('id', 'desc')->get();
        return view('admin.cntp.cntpregopen', compact('inboxings','comments'));
    }
    public function index2()
    {

        $inboxings = AirportDispach::wherein('status',[1,2])->orderBy('id', 'desc')->get();
        return view('admin.airport.mailarrived', compact('inboxings'));
    }
    public function store(Request $request)
    {
        $formField = $request->validate([
            'orgincountry' => 'required',
            'comment' => 'required',
            'grossweight' => 'required',
            'mailweight' => '',
            'dispatchNumber' => 'required',
            'currentweight' => 'required',
            'dispachetype' => 'required',
            'numberitem' => 'required',

        ]);


        $formField['airport_id'] = auth()->user()->id;
        $inbox = AirportDispach::create($formField);
        return to_route('admin.inbox.AirportDispach')->with('success','Registration done');
    }
    public function update(Request $request)
    {
        $currentDate = Carbon::now();

       foreach ($request->dispatchid as $value) {
            AirportDispach::findorfail($value)->update(['status' =>'2','cntppickupdate'=>$currentDate]);
        }

        return to_route('admin.cntp.CntpDispach')->with('success', 'Dispatch Approved Successfully');
    }
    public function filling(Request $request,$id)
    {
   $check = AirportDispach::where('grossweight',$request->cntpweight)->where('id',$id)->count();


    if ($request->dispachetype == 'EMS') {
            $airportDispatch = AirportDispach::findOrFail($id);

$request->validate([
    'emsweight' => 'numeric',
    'cntpcomment' => '',
]);

$airportDispatch->update([
    'mailnumber' => $request->ems,
    'cntpweight' => $request->cntpweight,
    'cntpcomment' => $request->cntpcomment,
    'mstatus' => 1,
]);

            $ems = TotalAllMails::first()->emst;
            TotalAllMails::first()->update(['emst' => $ems + $request->ems]);
        } elseif ($request->dispachetype == 'PERCEL') {
            $airportDispatch = AirportDispach::findOrFail($id);

            $request->validate([
                'percelweight' => 'numeric',
                'cntpcomment' => '',
            ]);

            $airportDispatch->update([
                'mailnumber' => $request->percel,
                'cntpweight' => $request->cntpweight,
                'cntpcomment' => $request->cntpcomment,
                'mstatus' => 1,
            ]);

            $percel = TotalAllMails::first()->pmt;
            TotalAllMails::first()->update(['pmt' => $percel + $request->percel]);
        }else {
            $numbers =$request->om.','.$request->ol.' ,'.$request->prm.','.$request->jr.','.$request->gad.','.$request->pcard;

            $airportDispatch = AirportDispach::findOrFail($id);

            $request->validate([
                'omweight' => '',
                'olweight' => '',
                'packagecomment' => '',
                'rpcomment' => '',
                'regstatus' => '',
            ]);

            $airportDispatch->update([
                'mailnumber' => $numbers,
                'omweight' => $request->omweight,
                'olweight' => $request->olweight,
                'prmweight' => $request->prmweight,
                'jurweight' => $request->jurweight,
                'gadeight' => $request->gadeight,
                'pcardeight' => $request->pcardeight,
                'packagecomment' => $request->packagecomment,
                'rpcomment' => $request->rpcomment,
                'regstatus' => $request->regstatus,

            ]);
        }
        return back()->with('success', 'Mail Opening was successfull and Registered');

    }

    //filling registered
    public function fillingreg(Request $request,$id)
    {
   $check = AirportDispach::where('grossweight',$request->cntpweight)->where('id',$id)->count();


    if ($request->dispachetype == 'EMS') {
            $airportDispatch = AirportDispach::findOrFail($id);

$request->validate([
    'emsweight' => 'numeric',
    'cntpcomment' => '',
]);

$airportDispatch->update([
    'mailnumber' => $request->ems,
    'cntpweight' => $request->cntpweight,
    'cntpcomment' => $request->cntpcomment,
    'mstatus' => 1,
]);

            $ems = TotalAllMails::first()->emst;
            TotalAllMails::first()->update(['emst' => $ems + $request->ems]);
        } elseif ($request->dispachetype == 'PERCEL') {
            $airportDispatch = AirportDispach::findOrFail($id);

            $request->validate([
                'percelweight' => 'numeric',
                'cntpcomment' => '',
            ]);

            $airportDispatch->update([
                'mailnumber' => $request->percel,
                'cntpweight' => $request->cntpweight,
                'cntpcomment' => $request->cntpcomment,
                'mstatus' => 1,
            ]);

            $percel = TotalAllMails::first()->pmt;
            TotalAllMails::first()->update(['pmt' => $percel + $request->percel]);
        }else {
            $numbers = $request->rm.','.$request->rl;

            $airportDispatch = AirportDispach::findOrFail($id);

            $request->validate([
                'rlweight' => '',

            ]);

            $airportDispatch->update([
                'mailnumberreg' => $numbers,

                'rlweight' => $request->rlweight,
                'rmweight' => $request->rmweight,
                'rpcomment' => $request->rpcomment,
                'regstatus' => 2,

            ]);
            $rm = TotalAllMails::first()->rmt;

            $rl = TotalAllMails::first()->rlt;

            TotalAllMails::first()->update([
                'rmt' => $rm + $request->rm,

                'rlt' => $rl + $request->rl,

            ]);
        }
        return back()->with('success', 'Mail Opening was successfull and Registered');

    }

    public function viewems($id){
        $inboxings = Outboxing::where('blanch',decrypt($id))
        ->orderBy('out_id', 'desc')
        ->get();
        $branches = Branch::where('id',decrypt($id))->get();
        return view('admin.cntp.ctntpemsview',compact('inboxings','branches'));

    }
    public function dailyreport()
    {
        $opens = DB::table('airport_dispaches')
        ->select(DB::raw('cntppickupdate'), DB::raw('SUM(cntpweight) as weight'), DB::raw('count(*) as total'))
        ->whereNotNull('mailnumber')
        ->groupBy('cntppickupdate')
        ->orderBy('cntppickupdate', 'DESC')
        ->limit(20)
        ->get();


        return view('admin.cntp.cntpreportopening', compact('opens'));
    }
    public function cntptaskdaily($cntppickupdate)
    {
        $currentDateTime = Carbon::now();
        $date = decrypt($cntppickupdate);
        $inboxings = AirportDispach::where('cntppickupdate', $date)
        ->whereNotNull('mailnumber')
        ->get();
        $pdf = PDF::loadView('admin.cntp.dailyopen', compact('date', 'inboxings','currentDateTime'))
            ->setPaper('a4', 'portrait');
        return $pdf->stream('Dailyopeningreport.pdf');
    }

    public function reportm()
    {
        $reps = DB::table('airport_dispaches')
            ->select(DB::raw('cntppickupdate'), DB::raw('SUM(cntpweight) as weight'), DB::raw('count(*) as total'), DB::raw('MONTH(cntppickupdate) as month'))
            ->groupBy('cntppickupdate', DB::raw('MONTH(cntppickupdate)'))
            ->orderBy('cntppickupdate', 'DESC')
            ->whereNotNull('mailnumber')
            ->groupBy(DB::raw('MONTH(cntppickupdate)'))
            ->get();

        return view('admin.cntp.monthlydispatchreport', compact('reps'));
    }
    public function cntptaskmonthly($month)
    {
        $currentDateTime = Carbon::now();
        $date = decrypt($month);
        $inboxings = DB::table('airport_dispaches')
            ->select('*',DB::raw('MONTH(cntppickupdate) as month'))
            ->whereNotNull('mailnumber')
            ->whereMonth('cntppickupdate', $date)
            ->get();

        $pdf = PDF::loadView('admin.cntp.detailsmonthrep', compact('date', 'inboxings','currentDateTime'))
            ->setPaper('a4', 'portrait');
        return $pdf->stream('Monthlyopeningreport.pdf');
    }



}
