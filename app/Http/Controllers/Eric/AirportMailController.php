<?php

namespace App\Http\Controllers\Eric;

use Carbon\Carbon;
use App\Models\User;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Eric\AirportDispach;
use App\Http\Controllers\Controller;
class AirportMailController extends Controller
{
    public function index()
    {
        $drivers =  User::where('level', 'driver')->whereNotNull('vehicle_id')->get();
        $inboxings = AirportDispach::where('status', 0)->orderBy('id', 'desc')->get();
        return view('admin.airport.airportdispach', compact('inboxings', 'drivers'));
    }
    public function index1()
    {
        $drivers = User::where('level', 'driver')->whereNotNull('vehicle_id')->get();
        $inboxings = AirportDispach::where('status', '1')->orderBy('id', 'desc')->get();
        return view('admin.airport.driverdispach', compact('inboxings', 'drivers'));
    }
    public function index2()
    {
        $drivers = User::where('level', 'driver')->whereNotNull('vehicle_id')->get();

        $inboxings = DB::table('airport_dispaches')
            ->join('users', 'airport_dispaches.postAgent', '=', 'users.id')
            ->select('airport_dispaches.*', 'users.name')->wherein('airport_dispaches.status', [0, 1, 2,3])->orderBy('airport_dispaches.id', 'desc')->get();
        return view('admin.airport.mailarrived', compact('inboxings', 'drivers'));
    }
    public function dispachApi()
    {

        $inboxings = DB::table('airport_dispaches')
            ->join('users', 'airport_dispaches.postAgent', '=', 'users.id')
            ->select('airport_dispaches.*', 'users.name')->where('airport_dispaches.status', 3)->orderBy('airport_dispaches.id', 'desc')->get();
        return response()->json([
            'data' => $inboxings,
            'status' => 200,
        ]);
    }
    public function store(Request $request)
    {
        $formField = $request->validate([
            'orgincountry' => 'required|string|regex:/^[A-Za-z\s]+$/',
            'comment' => 'required',
            'grossweight' => 'required|numeric|',
            'mailweight' => '',
             'dispatchNumber' => 'required|unique:airport_dispaches',
            'currentweight' => 'required|numeric|',
            'dispachetype' => 'required',
            'numberitem' => 'required|numeric|',

        ]);

        $formField['airport_id'] = auth()->user()->id;
        $inbox = AirportDispach::create($formField);
        return to_route('admin.inbox.AirportDispach')->with('success', 'Dispatch Registration Successfully');
    }
    public function update(Request $request)
    {
        $formField = $request->validate([

            'dispatchid' => 'required',
        ]);
        foreach ($request->dispatchid as $value) {
            AirportDispach::findorfail($value)->update([ 'status' => '1']);
        }

        return to_route('admin.inbox.AirportDispach')->with('success', 'Dispatch Transfered Successfully');
    }
    public function updateDispatch(Request $request, $id)
    {
        $formField = $request->validate([
            'orgincountry' => 'required|string|regex:/^[A-Za-z\s]+$/',
            'comment' => 'required',
            'grossweight' => 'required|numeric|',
            'mailweight' => '',
            'dispatchNumber' => 'required|numeric|unique:airport_dispaches,dispatchNumber,' . $id,
            'currentweight' => 'required|numeric|',
            'dispachetype' => 'required',
            'numberitem' => 'required|numeric|',
        ]);
        AirportDispach::findOrFail($id)->update($formField);
        return back()->with('success', 'Dispatch Updated Successfully');
    }

    public function report()
    {
        $reps = DB::table('airport_dispaches')
        ->select(DB::raw('MONTH(created_at) as month'), DB::raw('SUM(currentweight) as weight'), DB::raw('count(*) as total'))
        ->groupBy(DB::raw('MONTH(created_at)'))
        ->orderBy('month', 'DESC')
        ->limit(12)
        ->where('airport_id',auth()->user()->id)
        ->get();
         return view('admin.airport.monthlycategory', compact('reps'));
    }
    public function airportmonthly($month)
    {
        $currentDateTime = Carbon::now();
        $date = decrypt($month);
        $inboxings = DB::table('airport_dispaches')
            ->select('*',DB::raw('MONTH(created_at) as month'))
            ->whereMonth('created_at', $date)
            ->get();

        $pdf = PDF::loadView('admin.airport.detailmonthairport', compact('date', 'inboxings','currentDateTime'))
            ->setPaper('a4', 'portrait');
        return $pdf->stream('MonthlyAirportreport.pdf');
    }
    public function airportdaily($date)
    {
        $currentDateTime = Carbon::now();
        $date = decrypt($date);
        $inboxings = DB::table('airport_dispaches')
            ->select('*',DB::raw('DATE(created_at) as date'))
            ->whereDate('created_at', $date)
            ->get();

        $pdf = PDF::loadView('admin.airport.detailsdaily', compact('date', 'inboxings','currentDateTime'))
            ->setPaper('a4', 'portrait');
        return $pdf->stream('DailyAirportreport.pdf');
    }

       public function reportd()
    {
        $reps = DB::table('airport_dispaches')
        ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(currentweight) as weight'), DB::raw('count(*) as total'))
        ->groupBy('date')
        ->orderBy('date', 'DESC')
        ->limit(20)
        ->get();

        return view('admin.airport.dailyreport', compact('reps'));
    }

}
