<?php

namespace App\Http\Controllers;

use App\Models\loan;
use App\Models\tool;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $tools = tool::where('user_id', '=', auth()->id())->latest()->get();
        return view('tools.index', compact('tools'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, tool $tool): RedirectResponse
    {
        // $validated = $request->validate([
        //     'user_id' => Auth::user()->id,
        //     'endDate' => Carbon::now()->addWeeks(2),
        // ]);

        $tool->loan()->create([
            'user_id' => Auth::user()->id,
            'endDate' => Carbon::now()->addWeeks(2),
        ]);

        return redirect(route('tools.dashboard'));
    }

    /**
     * Display the specified resource.
     */
    public function show(loan $loan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(loan $loan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, loan $loan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(tool $tool): RedirectResponse
    {
        
    }
}
