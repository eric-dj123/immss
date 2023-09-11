<?php

namespace App\Http\Controllers\Eric\Backoffice;

use Carbon\Carbon;
use App\Models\Box;
use App\Models\Branch;
use App\Models\MailStock;
use App\Models\Eric\Namming;
use Illuminate\Http\Request;
use App\Models\Eric\Inboxing;
use App\Models\Eric\Transfer;
use App\Models\Eric\Notification;
use App\Models\Eric\TotalAllMails;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DispachRecievingController extends Controller
{
    public function index()
    {
        $boxes = Box::all();
        $branches = Branch::all();
        $results = Transfer::where('touserid', '=', auth()->user()->branch)->where('status', '0')
            ->orderBy('id', 'desc')->get();
        return view('admin.backoffice.depechereceive', compact('results', 'boxes', 'branches'));
    }
    public function update(Request $request, $id)
    {
        $formField = $request->validate([
            'inid' => 'required',
        ]);
        $currentDateTime = Carbon::now();
        foreach ($request->inid as $value) {
            $inboxing = Inboxing::findOrFail($value);

            // Update the fields with the new values
            $inboxing->update([
                'instatus' => '2',
                'rcndate' => now(), // This will set the transdate field to the current date and time
            ]);
        }
        Transfer::findorfail($id)->update(['status' => '1', 'rvdate' => $currentDateTime]);

        return back()->with('success', 'Thank you for receiveing this dispatch');
    }
    public function storepb(Request $request, $id)
    {

        $phone=auth()->user()->phone;
        $formField = $request->validate([
            'intracking' => 'required',
            'inname' => 'required',
            'orgcountry' => 'required',
            'phone' => 'required|numeric',
            'pob' => 'required',
            'location' => 'required',
            'weight' => 'required|numeric',
            'comment' => 'required',
            'akabati' => 'required',
        ]);
        $ddate = Carbon::now()->format('Y-m-d');
        $formField['mailtype'] = 'p';
        $formField['notification'] = '1';
        $formField['instatus'] = '3';
        $formField['amount'] = '0';
        $formField['transdate'] = $ddate;
        $formField['notdate'] = $ddate;
        $formField['rcndate'] = $ddate;
        $formField['pob_bid'] = $request->pob_bid;
        $formField['userid'] = auth()->user()->id;
        $formField['bid'] = auth()->user()->branch;
        $un = str_pad(Namming::where('type', 'p')->count() + 1, 4, "0", STR_PAD_LEFT);
        $formField['innumber'] = 'P-' . $un;
        $innumber = "P-" . $un;

            $inbox = Inboxing::create($formField);
            Namming::create(['type' => 'p', 'number' => $inbox->innumber]);

            $inid = DB::table('inboxings')->where('innumber', $innumber)->value('id');
            Notification::create([
                'userid' => auth()->user()->id,
                'bid' => auth()->user()->branch,
                'akabati' => $request->akabati,
                'phone' => $request->phone,
                'cid' => $id,
                'mailtype' => 'p',
                'weight' => $request->weight,
            ]);
            MailStock::create([
                'bid' => auth()->user()->branch,
                'mailin' => 'in',
                'mid' => $request->mid,
                'mailtype' => $request->mailtype,
                'datereceive' => $ddate,
            ]);
            $transferDetails = DB::table('transferdatails')->insert([
                'trid' => $request->id,
                'inid' => $inid,

            ]);


        if ($request->closes == '1') {
            $transfer = DB::table('transfers')->where('id', $request->trid)->update(['status' => '1']);
        }
        $curl = curl_init();
        $receiver = '+25' . $request->phone;
        $gu=8;

        $message = "IPOSITA $request->branch BRANCH informs you that you have  an item to pick at Guichet:$gu code:$innumber-$request->akabati If you need home delivery service,please call this number $phone";

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.mista.io/sms',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('to' => $receiver, 'from' => 'IPOSITA', 'unicode' => '0', 'sms' => $message, 'action' => 'send-sms'),
            CURLOPT_HTTPHEADER => array(
                'x-api-key:bkVxc3FQQmVtbEJhREtrY25DZW0=',
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return back()->with('success', 'Percel Mail Registed successful');
    }

    //insert ordinary
    public function storeoma(Request $request, $id)
    {
        $phone=auth()->user()->phone;
        $formField = $request->validate([
            'intracking' => 'required',
            'inname' => 'required',
            'orgcountry' => 'required',
            'phone' => 'required|numeric',
            'pob' => 'required',
            'location' => 'required',
            'weight' => 'required|numeric',
            'comment' => 'required',
            'akabati' => 'required',
        ]);
        $ddate = Carbon::now()->format('Y-m-d');
        $formField['mailtype'] = 'o';
        $formField['notification'] = '1';
        $formField['instatus'] = '3';
        $formField['amount'] = '500';
        $formField['transdate'] = $ddate;
        $formField['notdate'] = $ddate;
        $formField['rcndate'] = $ddate;
        $formField['userid'] = auth()->user()->id;
        $formField['bid'] = auth()->user()->branch;
        $un = str_pad(Namming::where('type', 'o')->count() + 1, 4, "0", STR_PAD_LEFT);
        $formField['innumber'] = 'O-' . $un;
        $innumber = "O-" . $un;

            $inbox = Inboxing::create($formField);
            Namming::create(['type' => 'o', 'number' => $inbox->innumber]);

            $inid = DB::table('inboxings')->where('innumber', $innumber)->value('id');
            Notification::create([
                'userid' => auth()->user()->id,
                'bid' => auth()->user()->branch,
                'akabati' => $request->akabati,
                'phone' => $request->phone,
                'cid' => $id,
                'mailtype' => 'o',
                'weight' => $request->weight,
            ]);
            MailStock::create([
                'bid' => auth()->user()->branch,
                'mailin' => 'in',

                'mailtype' => $request->mailtype,
                'datereceive' => $ddate,
            ]);

            $transferDetails = DB::table('transferdatails')->insert([
                'trid' => $request->id,
                'inid' => $inid,

            ]);


        if ($request->closes == '1') {
            $transfer = DB::table('transfers')->where('id', $request->trid)->update(['status' => '1']);
        }
        $curl = curl_init();
        $receiver = '+25' . $request->phone;
        $gu=8;

        $message = "IPOSITA $request->branch BRANCH informs you that you have an item to pick at Guichet:$gu code:$innumber-$request->akabati If you need home delivery service,please call this number $phone";

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.mista.io/sms',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('to' => $receiver, 'from' => 'IPOSITA', 'unicode' => '0', 'sms' => $message, 'action' => 'send-sms'),
            CURLOPT_HTTPHEADER => array(
                'x-api-key:bkVxc3FQQmVtbEJhREtrY25DZW0=',
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return back()->with('success', 'Ordinary Mail Registered successful');
    }
    public function storerm(Request $request, $id)
    {
        $phone=auth()->user()->phone;
        $formField = $request->validate([
            'intracking' => 'required',
            'inname' => 'required',
            'orgcountry' => 'required',
            'phone' => 'required|numeric',
            'pob' => 'required',
            'location' => 'required',
            'weight' => 'required|numeric',
            'comment' => 'required',
            'akabati' => 'required',
        ]);
        $ddate = Carbon::now()->format('Y-m-d');
        $formField['mailtype'] = 'r';
        $formField['notification'] = '1';
        $formField['instatus'] = '3';
        $formField['amount'] = '0';
        $formField['transdate'] = $ddate;
        $formField['notdate'] = $ddate;
        $formField['rcndate'] = $ddate;
        $formField['userid'] = auth()->user()->id;
        $formField['bid'] = auth()->user()->branch;
        $un = str_pad(Namming::where('type', 'r')->count() + 1, 4, "0", STR_PAD_LEFT);
        $formField['innumber'] = 'R-' . $un;
        $innumber = "R-" . $un;

            $inbox = Inboxing::create($formField);
            Namming::create(['type' => 'o', 'number' => $inbox->innumber]);

            $inid = DB::table('inboxings')->where('innumber', $innumber)->value('id');
            Notification::create([
                'userid' => auth()->user()->id,
                'bid' => auth()->user()->branch,
                'akabati' => $request->akabati,
                'phone' => $request->phone,
                'cid' => $id,
                'mailtype' => 'r',
                'weight' => $request->weight,
            ]);
            MailStock::create([
                'bid' => auth()->user()->branch,
                'mailin' => 'in',

                'mailtype' => $request->mailtype,
                'datereceive' => $ddate,
            ]);

            $transferDetails = DB::table('transferdatails')->insert([
                'trid' => $request->id,
                'inid' => $inid,

            ]);


        if ($request->closes == '1') {
            $transfer = DB::table('transfers')->where('id', $request->trid)->update(['status' => '1']);
        }
        $curl = curl_init();
        $receiver = '+25' . $request->phone;
        $gu=8;

        $message = "IPOSITA  $request->branch BRANCH informs you that you have an item to pick at Guichet:$gu code:$innumber-$request->akabati If you need home delivery service,please call this number $phone";

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.mista.io/sms',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('to' => $receiver, 'from' => 'IPOSITA', 'unicode' => '0', 'sms' => $message, 'action' => 'send-sms'),
            CURLOPT_HTTPHEADER => array(
                'x-api-key:bkVxc3FQQmVtbEJhREtrY25DZW0=',
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return back()->with('success', 'Ordinary Mail Registered successful');
    }

    public function storeems(Request $request, $id)
    {
        $phone=auth()->user()->phone;
        $formField = $request->validate([
            'intracking' => 'required',
            'inname' => 'required',
            'orgcountry' => 'required',
            'phone' => 'required|numeric',
            'pob' => 'required',
            'location' => 'required',
            'weight' => 'required|numeric',
            'comment' => 'required',
            'akabati' => 'required',
        ]);
        $ddate = Carbon::now()->format('Y-m-d');
        $formField['mailtype'] = 'ems';
        $formField['notification'] = '1';
        $formField['instatus'] = '3';
        $formField['amount'] = '0';
        $formField['transdate'] = $ddate;
        $formField['notdate'] = $ddate;
        $formField['rcndate'] = $ddate;
        $formField['userid'] = auth()->user()->id;
        $formField['bid'] = auth()->user()->branch;
        $un = str_pad(Namming::where('type', 'ems')->count() + 1, 4, "0", STR_PAD_LEFT);
        $formField['innumber'] = 'E-' . $un;
        $innumber = "E-" . $un;

            $inbox = Inboxing::create($formField);
            Namming::create(['type' => 'ems', 'number' => $inbox->innumber]);

            $inid = DB::table('inboxings')->where('innumber', $innumber)->value('id');
            Notification::create([
                'userid' => auth()->user()->id,
                'bid' => auth()->user()->branch,
                'akabati' => $request->akabati,
                'phone' => $request->phone,
                'cid' => $id,
                'mailtype' => 'ems',
                'weight' => $request->weight,
            ]);
            MailStock::create([
                'bid' => auth()->user()->branch,
                'mailin' => 'in',

                'mailtype' => $request->mailtype,
                'datereceive' => $ddate,
            ]);

            $transferDetails = DB::table('transferdatails')->insert([
                'trid' => $request->id,
                'inid' => $inid,

            ]);


        if ($request->closes == '1') {
            $transfer = DB::table('transfers')->where('id', $request->trid)->update(['status' => '1']);
        }
        $curl = curl_init();
        $receiver = '+25' . $request->phone;
        $gu=8;

        $message = "IPOSITA $request->branch BRANCH informs you that you have an item to pick at Guichet:$gu code:$innumber-$request->akabati If you need home delivery service,please call this number $phone";

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.mista.io/sms',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('to' => $receiver, 'from' => 'IPOSITA', 'unicode' => '0', 'sms' => $message, 'action' => 'send-sms'),
            CURLOPT_HTTPHEADER => array(
                'x-api-key:bkVxc3FQQmVtbEJhREtrY25DZW0=',
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return back()->with('success', 'EMS Mail Registered successful');
    }
    public function storepostalcard(Request $request, $id)
    {
        $phone=auth()->user()->phone;
        $formField = $request->validate([
            'intracking' => 'required',
            'inname' => 'required',
            'orgcountry' => 'required',
            'phone' => 'required|numeric',
            'pob' => 'required',
            'location' => 'required',
            'weight' => 'required|numeric',
            'comment' => 'required',
            'akabati' => 'required',
        ]);
        $ddate = Carbon::now()->format('Y-m-d');
        $formField['mailtype'] = 'POD';
        $formField['notification'] = '1';
        $formField['instatus'] = '3';
        $formField['amount'] = '0';
        $formField['transdate'] = $ddate;
        $formField['notdate'] = $ddate;
        $formField['rcndate'] = $ddate;
        $formField['userid'] = auth()->user()->id;
        $formField['bid'] = auth()->user()->branch;
        $un = str_pad(Namming::where('type', 'POD')->count() + 1, 4, "0", STR_PAD_LEFT);
        $formField['innumber'] = 'POD-' . $un;
        $innumber = "POD-" . $un;

            $inbox = Inboxing::create($formField);
            Namming::create(['type' => 'POD', 'number' => $inbox->innumber]);

            $inid = DB::table('inboxings')->where('innumber', $innumber)->value('id');
            Notification::create([
                'userid' => auth()->user()->id,
                'bid' => auth()->user()->branch,
                'akabati' => $request->akabati,
                'phone' => $request->phone,
                'cid' => $id,
                'mailtype' => 'POD',
                'weight' => $request->weight,
            ]);
            MailStock::create([
                'bid' => auth()->user()->branch,
                'mailin' => 'in',

                'mailtype' => $request->mailtype,
                'datereceive' => $ddate,
            ]);

            $transferDetails = DB::table('transferdatails')->insert([
                'trid' => $request->id,
                'inid' => $inid,

            ]);


        if ($request->closes == '1') {
            $transfer = DB::table('transfers')->where('id', $request->trid)->update(['status' => '1']);
        }
        $curl = curl_init();
        $receiver = '+25' . $request->phone;
        $gu=8;

        $message = "IPOSITA $request->branch BRANCH informs you that you have an item to pick at Guichet:$gu code:$innumber-$request->akabati If you need home delivery service,please call this number $phone";

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.mista.io/sms',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('to' => $receiver, 'from' => 'IPOSITA', 'unicode' => '0', 'sms' => $message, 'action' => 'send-sms'),
            CURLOPT_HTTPHEADER => array(
                'x-api-key:bkVxc3FQQmVtbEJhREtrY25DZW0=',
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return back()->with('success', 'Postal Card  Mail Registered successful');
    }
    public function storegooglead(Request $request, $id)
    {
        $phone=auth()->user()->phone;
        $formField = $request->validate([
            'intracking' => 'required',
            'inname' => 'required',
            'orgcountry' => 'required',
            'phone' => 'required|numeric',
            'pob' => 'required',
            'location' => 'required',
            'weight' => 'required|numeric',
            'comment' => 'required',
            'akabati' => 'required',
        ]);
        $ddate = Carbon::now()->format('Y-m-d');
        $formField['mailtype'] = 'GAD';
        $formField['notification'] = '1';
        $formField['instatus'] = '3';
        $formField['amount'] = '1000';
        $formField['transdate'] = $ddate;
        $formField['notdate'] = $ddate;
        $formField['rcndate'] = $ddate;
        $formField['userid'] = auth()->user()->id;
        $formField['bid'] = auth()->user()->branch;
        $un = str_pad(Namming::where('type', 'GAD')->count() + 1, 4, "0", STR_PAD_LEFT);
        $formField['innumber'] = 'GAD-' . $un;
        $innumber = "GAD-" . $un;

            $inbox = Inboxing::create($formField);
            Namming::create(['type' => 'GAD', 'number' => $inbox->innumber]);

            $inid = DB::table('inboxings')->where('innumber', $innumber)->value('id');
            Notification::create([
                'userid' => auth()->user()->id,
                'bid' => auth()->user()->branch,
                'akabati' => $request->akabati,
                'phone' => $request->phone,
                'cid' => $id,
                'mailtype' => 'GAD',
                'weight' => $request->weight,
            ]);
            MailStock::create([
                'bid' => auth()->user()->branch,
                'mailin' => 'in',

                'mailtype' => $request->mailtype,
                'datereceive' => $ddate,
            ]);

            $transferDetails = DB::table('transferdatails')->insert([
                'trid' => $request->id,
                'inid' => $inid,

            ]);


        if ($request->closes == '1') {
            $transfer = DB::table('transfers')->where('id', $request->trid)->update(['status' => '1']);
        }
        $curl = curl_init();
        $receiver = '+25' . $request->phone;
        $gu=8;

        $message = "IPOSITA $request->branch BRANCH informs you that you have an item to pick at Guichet:$gu code:$innumber-$request->akabati If you need home delivery service,please call this number $phone";

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.mista.io/sms',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('to' => $receiver, 'from' => 'IPOSITA', 'unicode' => '0', 'sms' => $message, 'action' => 'send-sms'),
            CURLOPT_HTTPHEADER => array(
                'x-api-key:bkVxc3FQQmVtbEJhREtrY25DZW0=',
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return back()->with('success', 'Google Adjacent  Mail Registered successful');
    }

    public function storejurnal(Request $request, $id)
    {
        $phone=auth()->user()->phone;
        $formField = $request->validate([
            'intracking' => 'required',
            'inname' => 'required',
            'orgcountry' => 'required',
            'phone' => 'required|numeric',
            'pob' => 'required',
            'location' => 'required',
            'weight' => 'required|numeric',
            'comment' => 'required',
            'akabati' => 'required',
        ]);
        $ddate = Carbon::now()->format('Y-m-d');
        $formField['mailtype'] = 'JUR';
        $formField['notification'] = '1';
        $formField['instatus'] = '3';
        $formField['amount'] = '0';
        $formField['transdate'] = $ddate;
        $formField['notdate'] = $ddate;
        $formField['rcndate'] = $ddate;
        $formField['userid'] = auth()->user()->id;
        $formField['bid'] = auth()->user()->branch;
        $un = str_pad(Namming::where('type', 'JUR')->count() + 1, 4, "0", STR_PAD_LEFT);
        $formField['innumber'] = 'JUR-' . $un;
        $innumber = "JUR-" . $un;

            $inbox = Inboxing::create($formField);
            Namming::create(['type' => 'JUR', 'number' => $inbox->innumber]);

            $inid = DB::table('inboxings')->where('innumber', $innumber)->value('id');
            Notification::create([
                'userid' => auth()->user()->id,
                'bid' => auth()->user()->branch,
                'akabati' => $request->akabati,
                'phone' => $request->phone,
                'cid' => $id,
                'mailtype' => 'JUR',
                'weight' => $request->weight,
            ]);
            MailStock::create([
                'bid' => auth()->user()->branch,
                'mailin' => 'in',

                'mailtype' => $request->mailtype,
                'datereceive' => $ddate,
            ]);

            $transferDetails = DB::table('transferdatails')->insert([
                'trid' => $request->id,
                'inid' => $inid,

            ]);


        if ($request->closes == '1') {
            $transfer = DB::table('transfers')->where('id', $request->trid)->update(['status' => '1']);
        }
        $curl = curl_init();
        $receiver = '+25' . $request->phone;
        $gu=8;

        $message = "IPOSITA $request->branch BRANCH informs you that you have an item to pick at Guichet:$gu code:$innumber-$request->akabati If you need home delivery service,please call this number $phone";

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.mista.io/sms',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('to' => $receiver, 'from' => 'IPOSITA', 'unicode' => '0', 'sms' => $message, 'action' => 'send-sms'),
            CURLOPT_HTTPHEADER => array(
                'x-api-key:bkVxc3FQQmVtbEJhREtrY25DZW0=',
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return back()->with('success', 'Jurnal Mail Registered successful');
    }

    public function storeprinted(Request $request, $id)
    {
        $phone=auth()->user()->phone;
        $formField = $request->validate([
            'intracking' => 'required',
            'inname' => 'required',
            'orgcountry' => 'required',
            'phone' => 'required|numeric',
            'pob' => 'required',
            'location' => 'required',
            'weight' => 'required|numeric',
            'comment' => 'required',
            'akabati' => 'required',
        ]);
        $ddate = Carbon::now()->format('Y-m-d');
        $formField['mailtype'] = 'PRM';
        $formField['notification'] = '1';
        $formField['instatus'] = '3';
        $formField['amount'] = '0';
        $formField['transdate'] = $ddate;
        $formField['notdate'] = $ddate;
        $formField['rcndate'] = $ddate;
        $formField['userid'] = auth()->user()->id;
        $formField['bid'] = auth()->user()->branch;
        $un = str_pad(Namming::where('type', 'PRM')->count() + 1, 4, "0", STR_PAD_LEFT);
        $formField['innumber'] = 'PRM-' . $un;
        $innumber = "PRM-" . $un;

            $inbox = Inboxing::create($formField);
            Namming::create(['type' => 'PRM', 'number' => $inbox->innumber]);

            $inid = DB::table('inboxings')->where('innumber', $innumber)->value('id');
            Notification::create([
                'userid' => auth()->user()->id,
                'bid' => auth()->user()->branch,
                'akabati' => $request->akabati,
                'phone' => $request->phone,
                'cid' => $id,
                'mailtype' => 'PRM',
                'weight' => $request->weight,
            ]);
            MailStock::create([
                'bid' => auth()->user()->branch,
                'mailin' => 'in',

                'mailtype' => $request->mailtype,
                'datereceive' => $ddate,
            ]);

            $transferDetails = DB::table('transferdatails')->insert([
                'trid' => $request->id,
                'inid' => $inid,

            ]);


        if ($request->closes == '1') {
            $transfer = DB::table('transfers')->where('id', $request->trid)->update(['status' => '1']);
        }
        $curl = curl_init();
        $receiver = '+25' . $request->phone;
        $gu=8;

        $message = "IPOSITA $request->branch BRANCH informs you that you have an item to pick at Guichet:$gu code:$innumber-$request->akabati If you need home delivery service,please call this number $phone";

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.mista.io/sms',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('to' => $receiver, 'from' => 'IPOSITA', 'unicode' => '0', 'sms' => $message, 'action' => 'send-sms'),
            CURLOPT_HTTPHEADER => array(
                'x-api-key:bkVxc3FQQmVtbEJhREtrY25DZW0=',
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return back()->with('success', 'Printed Material Mail Registered successful');
    }

    public function storeletterod(Request $request, $id)
    {
        $phone=auth()->user()->phone;
        $formField = $request->validate([

            'inname' => 'required',
            'orgcountry' => 'required',
            'phone' => 'required|numeric',
            'pob' => 'required',
            'location' => 'required',
            'akabati' => 'required',
        ]);
        $ddate = Carbon::now()->format('Y-m-d');
        $formField['mailtype'] = 'ol';
        $formField['notification'] = '1';
        $formField['instatus'] = '3';
        $formField['amount'] = '0';
        $formField['transdate'] = $ddate;
        $formField['weight'] = 0;
        $formField['notdate'] = $ddate;
        $formField['rcndate'] = $ddate;
        $formField['userid'] = auth()->user()->id;
        $formField['bid'] = auth()->user()->branch;
        $un = str_pad(Namming::where('type', 'ol')->count() + 1, 4, "0", STR_PAD_LEFT);
        $formField['innumber'] = 'OL-' . $un;
        $innumber = "OL-" . $un;

            $inbox = Inboxing::create($formField);
            Namming::create(['type' => 'ol', 'number' => $inbox->innumber]);

            $inid = DB::table('inboxings')->where('innumber', $innumber)->value('id');
            Notification::create([
                'userid' => auth()->user()->id,
                'bid' => auth()->user()->branch,
                'akabati' => $request->akabati,
                'phone' => $request->phone,
                'cid' => $id,
                'mailtype' => 'ol',
                'weight' => 0,
            ]);
            MailStock::create([
                'bid' => auth()->user()->branch,
                'mailin' => 'in',

                'mailtype' => $request->mailtype,
                'datereceive' => $ddate,
            ]);
            $transferDetails = DB::table('transferdatails')->insert([
                'trid' => $request->id,
                'inid' => $inid,

            ]);


        if ($request->closes == '1') {
            $transfer = DB::table('transfers')->where('id', $request->trid)->update(['status' => '1']);
        }
        $curl = curl_init();
        $receiver = '+25' . $request->phone;
        $gu=8;

        $message = "IPOSITA $request->branch BRANCH informs you that you have an item to pick at Guichet:$gu code:$innumber-$request->akabati If you need home delivery service,please call this number $phone";

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.mista.io/sms',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('to' => $receiver, 'from' => 'IPOSITA', 'unicode' => '0', 'sms' => $message, 'action' => 'send-sms'),
            CURLOPT_HTTPHEADER => array(
                'x-api-key:bkVxc3FQQmVtbEJhREtrY25DZW0=',
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return back()->with('success', 'Ordinary Letter Registration successful');

    }
    public function storeletterodreg(Request $request, $id)
    {
        $phone=auth()->user()->phone;
        $formField = $request->validate([

            'inname' => 'required',
            'orgcountry' => 'required',
            'phone' => 'required|numeric',
            'pob' => 'required',
            'location' => 'required',
            'akabati' => 'required',
        ]);
        $ddate = Carbon::now()->format('Y-m-d');
        $formField['mailtype'] = 'rl';
        $formField['notification'] = '1';
        $formField['instatus'] = '3';
        $formField['amount'] = '0';
        $formField['transdate'] = $ddate;
        $formField['weight'] = 0;
        $formField['notdate'] = $ddate;
        $formField['rcndate'] = $ddate;
        $formField['userid'] = auth()->user()->id;
        $formField['bid'] = auth()->user()->branch;
        $un = str_pad(Namming::where('type', 'rl')->count() + 1, 4, "0", STR_PAD_LEFT);
        $formField['innumber'] = 'RL-' . $un;
        $innumber = "RL-" . $un;

            $inbox = Inboxing::create($formField);
            Namming::create(['type' => 'rl', 'number' => $inbox->innumber]);

            $inid = DB::table('inboxings')->where('innumber', $innumber)->value('id');
            Notification::create([
                'userid' => auth()->user()->id,
                'bid' => auth()->user()->branch,
                'akabati' => $request->akabati,
                'phone' => $request->phone,
                'cid' => $id,
                'mailtype' => 'rl',
                'weight' => 0,
            ]);
            MailStock::create([
                'bid' => auth()->user()->branch,
                'mailin' => 'in',

                'mailtype' => $request->mailtype,
                'datereceive' => $ddate,
            ]);

            $transferDetails = DB::table('transferdatails')->insert([
                'trid' => $request->id,
                'inid' => $inid,

            ]);


        if ($request->closes == '1') {
            $transfer = DB::table('transfers')->where('id', $request->trid)->update(['status' => '1']);
        }
        $curl = curl_init();
        $receiver = '+25' . $request->phone;
        $gu=8;

        $message = "IPOSITA $request->branch BRANCH informs you that you have an item to pick at Guichet:$gu code:$innumber-$request->akabati If you need home delivery service,please call this number $phone";

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.mista.io/sms',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('to' => $receiver, 'from' => 'IPOSITA', 'unicode' => '0', 'sms' => $message, 'action' => 'send-sms'),
            CURLOPT_HTTPHEADER => array(
                'x-api-key:bkVxc3FQQmVtbEJhREtrY25DZW0=',
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return back()->with('success', 'Registered Letter Registration successful');

    }





}
