<?php

namespace App\Http\Controllers\Eric\Backoffice;

use Illuminate\Http\Request;
use App\Models\Eric\Inboxing;
use App\Http\Controllers\Controller;

class MailListController extends Controller
{

    public function all(Request $request)
    {
        $query = $request->input('query');

        if ($query) {
            $inboxings = Inboxing::where(function ($queryBuilder) use ($query) {
                $queryBuilder->where('inname', 'like', '%' . $query . '%')
                             ->orWhere('intracking', 'like', '%' . $query . '%')
                             ->orWhere('innumber', 'like', '%' . $query . '%')
                             ->orWhere('phone', 'like', '%' . $query . '%')
                             ->orWhere('created_at', 'like', '%' . $query . '%');
            })->get();

        } else {
            $inboxings = null;
        }
        return view('admin.backoffice.maillist', compact('inboxings'));
    }


}
