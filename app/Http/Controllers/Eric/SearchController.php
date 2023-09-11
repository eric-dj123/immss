<?php

namespace App\Http\Controllers\Eric;

use Illuminate\Http\Request;
use App\Models\Eric\Inboxing;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function liveSearch(Request $request)
    {
        $query = $request->input('query');

        // Implement your search logic here using Eloquent queries or any other method suitable for your application.
        $results = Inboxing::where('phone', 'LIKE', "%{$query}%")->get();

        return response()->json($results);
    }
}
