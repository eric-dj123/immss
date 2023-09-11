<?php

namespace App\Http\Controllers\Eric\Backoffice;

use Illuminate\Http\Request;
use App\Models\Eric\Inboxing;
use App\Models\Eric\Courierpay;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class MailDeliveryController extends Controller
{
    public function index()
    {
        $pays= Courierpay::all();
        return view('admin.backoffice.maildelevery', compact('pays'));
    }
    public function invoice($cid)
    {
        $pay = Inboxing::find($cid);
        $pdf = Pdf::loadView('admin.backoffice.pickupinvoice', compact('pay'))
            ->setPaper('a7', 'portrait');
        return $pdf->stream('invoice.pdf');
    }
}
