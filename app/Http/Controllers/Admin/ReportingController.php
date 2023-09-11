<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Expense_types;
use App\Models\Income_types;
use App\Models\Item;
use Illuminate\Http\Request;

class ReportingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $branches = Branch::orderBy('name', 'asc')->get();
        $items = Item::where('category', '!=', '3')->get();
        $incometypes = Income_types::all();
        return view('admin.reporting.index', compact('branches', 'items', 'incometypes'));
    }
    public function daily()
    {
        //
        $branches = Branch::orderBy('name', 'asc')->get();
        $items = Item::all();
        $incometypes = Income_types::all();
        return view('admin.reporting.daily', compact('branches', 'items', 'incometypes'));
    }
    public function monthly()
    {
        //
        $branches = Branch::orderBy('name', 'asc')->get();
        $items = Item::all();
        $incometypes = Income_types::all();
        return view('admin.reporting.monthly', compact('branches', 'items', 'incometypes'));
    }
    public function profit()
    {
        //
        $branches = Branch::orderBy('name', 'asc')->get();
        $items = Item::all();
        $incometypes = Income_types::all();
        return view('admin.reporting.profit', compact('branches', 'items', 'incometypes'));
    }

    public function expenses()
    {
        //
        $branches = Branch::orderBy('name', 'asc')->get();
        // $items = Item::all();
        $expensetypes = Expense_types::all();
        return view('admin.reporting.expenses', compact('branches', 'expensetypes'));
    }

    public function ems()
    {
        return view('admin.reporting.ems');
    }
    public function registered()
    {
        return view('admin.reporting.registered');
    }
    public function percel()
    {
        return view('admin.reporting.percel');
    }
    public function temble()
    {
        return view('admin.reporting.temble');
    }
    public function postel()
    {
        return view('admin.reporting.postel');
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
