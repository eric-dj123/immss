<?php

namespace App\Http\Controllers\Admin;

use App\Models\Item;
use App\Models\Branch;
use App\Models\Income_types;
use Illuminate\Http\Request;
use App\Models\Expense_types;
use App\Http\Controllers\Controller;

class BranchReportingController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index()
    {
    //
        $branches = Branch::where('id',auth()->user()->branch)->orderBy('name', 'asc')->get();
        $items = Item::where('category', '!=', '3')->get();
        $incometypes = Income_types::all();
        return view('admin.branchreporting.index', compact('branches', 'items', 'incometypes'));
    }
    public function daily()
    {
        //
        $branches = Branch::where('id',auth()->user()->branch)->orderBy('name', 'asc')->get();
        $items = Item::all();
        $incometypes = Income_types::all();
        return view('admin.branchreporting.daily', compact('branches', 'items', 'incometypes'));
    }
    public function monthly()
    {
        //
        $branches = Branch::where('id',auth()->user()->branch)->orderBy('name', 'asc')->get();
        $items = Item::all();
        $incometypes = Income_types::all();
        return view('admin.branchreporting.monthly', compact('branches', 'items', 'incometypes'));
    }
    public function profit()
    {
        //
        $branches = Branch::where('id',auth()->user()->branch)->orderBy('name', 'asc')->get();
        $items = Item::all();
        $incometypes = Income_types::all();
        return view('admin.branchreporting.profit', compact('branches', 'items', 'incometypes'));
    }

    public function expenses()
    {
        //
        $branches = Branch::where('id',auth()->user()->branch)->orderBy('name', 'asc')->get();
        // $items = Item::all();
        $expensetypes = Expense_types::all();
        return view('admin.branchreporting.expenses', compact('branches', 'expensetypes'));
    }

    public function ems()
    {
        return view('admin.branchreporting.ems');
    }
    public function registered()
    {
        return view('admin.branchreporting.registered');
    }
    public function percel()
    {
        return view('admin.branchreporting.percel');
    }
    public function temble()
    {
        return view('admin.branchreporting.temble');
    }
    public function postel()
    {
        return view('admin.branchreporting.postel');
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
        //
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
