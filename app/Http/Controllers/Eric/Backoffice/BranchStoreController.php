<?php

namespace App\Http\Controllers\Eric\Backoffice;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class BranchStoreController extends Controller
{
    public function index()
    {
        $reps = DB::table('mail_stocks')
        ->select(DB::raw('DATE(datereceive) as date'))
        ->groupBy(DB::raw('DATE(datereceive)'))
        ->orderBy('date', 'DESC')
        ->limit(12)
        ->get();
         return view('admin.backoffice.branchstore', compact('reps'));
    }
}
