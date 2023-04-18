<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Special;
use App\Models\Neighborhood;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SpecialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $specials = Special::search($request)->paginate(20);

        return view('admin.specials.index')
            ->withSpecials($specials);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $units = Unit::where('status', 'active')->get();
        $neighborhoods = Neighborhood::where('status', 'active')->get();

        return view('admin.specials.create')
            ->withUnits($units)
            ->withNeighborhoods($neighborhoods);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'amount' => [
                'required',
                'numeric',
                Rule::when($request->input('type') === 'percentage', 'lte:100')
            ],
            'start_date' => ['required', 'after_or_equal:today', 'before_or_equal:end_date'],
            'end_date' => ['required', 'after_or_equal:start_date'],
        ]);
        
        $special = Special::create($request->except(['_token']));

        return redirect()->route('admin.specials.edit', $special);
    }

    /**
     * Display the specified resource.
     */
    public function show(Special $special)
    {
        return view('admin.specials.show')
            ->withSpecial($special);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Special $special)
    {
        $units = Unit::where('status', 'active')->get();
        $neighborhoods = Neighborhood::where('status', 'active')->get();

        return view('admin.specials.update')
            ->withSpecial($special)
            ->withUnits($units)
            ->withNeighborhoods($neighborhoods);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Special $special)
    {
        $special->update($request->except(['_token', '_method']));

        return redirect()->route('admin.specials.edit')
            ->withSpecial($special);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Special $special)
    {
        $special->delete();

        return redirect()->route('admin.specials.index');
    }
}
