<?php

namespace App\Http\Controllers\Cntp;

use App\Models\Box;
use App\Models\Branch;
use App\Models\Eric\Namming;
use Illuminate\Http\Request;
use App\Models\Eric\Inboxing;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PostCardMailController extends Controller
{
    public function index()
    {
        $results = DB::table('total_all_mails')->select('omt')->get();
        $branches = Branch::all();
        return view('admin.register.postcardregistration', compact('branches','results'));
    }
    public function registerpri($id){
        $inboxings = Inboxing::where('location',decrypt($id))->where('instatus','0')->where('mailtype','POD')
        ->orderBy('id', 'desc')->get();
        $boxes = Box::all();
        $branches = Branch::all();
        $bras = Branch::where('id',decrypt($id))->get();
        return view('admin.register.postcardormreg',compact('branches','boxes','id','inboxings','bras'));

    }
    public function store(Request $request)
    {
        $formField = $request->validate([
            'intracking' => '',
            'inname' => 'required|string|regex:/^[A-Za-z\s]+$/',
            'orgcountry' => 'required|string|regex:/^[A-Za-z\s]+$/',
            'phone' => '',
            'pob' => '',
            'location' => 'required|numeric',
            'weight' => 'required|numeric',
            'comment' => 'required',
            'pob_bid' => 'numeric',
        ]);
        $pob = (int) $request->pob;
        $box = Box::where('pob',$pob)->where('branch_id',$request->pob_bid)->first();
        $pobnum = ($box) ? $box->customer_id : null ;

        $formField['customer_id'] =  $pobnum;
        $formField['mailtype'] = 'POD';
        $formField['amount'] = '0';
        $formField['userid'] = auth()->user()->id;
        $formField['bid'] = auth()->user()->branch;
        $un=str_pad(Namming::where('type', 'POD')->count()+1,4,"0",STR_PAD_LEFT);
        $formField['innumber'] = 'POD-'. $un;
        if($request->intracking == 0){
           $totalomt = Branch::where('id',$request->location)->sum('podt');
        if ($totalomt == 0) {
           return back()->with('warning', 'Mail not Registered Becouse Quantity Remaining is 0 .');
        } else {
            if($totalomt==0){
                return back()->with('warning', 'Mail not Registered Becouse Quantity Remaining is 0 .');
            }
            else{

           $inbox = Inboxing::create($formField);
        Namming::create(['type' => 'POD', 'number' => $inbox->innumber ]);
        Branch::where('id',$request->location)->decrement('podt');
        }
    }
        $newtotal = Branch::where('id',$request->location)->sum('podt');
        }
        else{
            $totalomt = Branch::where('id',$request->location)->sum('podt');
            if($totalomt ==0){
                return back()->with('warning', 'Mail not Registered Becouse Quantity Remaining is 0 .');
            }
            else{

           $inboxings = Inboxing::where('intracking',$request->intracking)->where('mailtype','POD')->count();
           if($inboxings == 0){
               $inbox = Inboxing::create($formField);
               Namming::create(['type' => 'POD', 'number' => $inbox->innumber ]);
               Branch::where('id',$request->location)->decrement('podt');
               $newtotal = Branch::where('id',$request->location)->sum('podt');
           }
           else{
               return back()->with('warning', 'Mail not Registered Becouse Tracking Number is already exists');
           }
        }
           $newtotal = Branch::where('id',$request->location)->sum('podt');

        }


        return back()->with('success', 'Printed Material Registration successful and Quantity Remaining Are: .'. $newtotal);
    }
    public function update(Request $request,$id)
    {
        $formField = $request->validate([
            'intracking' => '',
            'inname' => 'required|string|regex:/^[A-Za-z\s]+$/',
            'orgcountry' => 'required|string|regex:/^[A-Za-z\s]+$/',
            'phone' => '',
            'pob' => '',
            'weight' => 'required|numeric',
            'comment' => 'required',
            'pob_bid' => 'numeric',
        ]);
        $box = Box::where('pob',$request->pob)->where('branch_id',$request->pob_bid)->first();
        $formField['customer_id'] = $box->customer_id;
        Inboxing::findorfail($id)->update($formField);
        return back()->with('success', 'PODnal Mail Updated Successfully');
    }
}
