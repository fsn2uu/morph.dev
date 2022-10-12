<?php

namespace App\Http\Controllers;

use App\Models\Traveler;
use Illuminate\Http\Request;

class TravelerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $travelers = Traveler::all();

        return view('admin.travelers.index')
            ->withTravelers($travelers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.travelers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $traveler = Traveler::create($request->except(['_token', '_method']));

        return redirect()->route('admin.travelers.edit', $traveler);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Traveler  $traveler
     * @return \Illuminate\Http\Response
     */
    public function show(Traveler $traveler)
    {
        return view('admin.travelers.show')
            ->withTraveler($traveler);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Traveler  $traveler
     * @return \Illuminate\Http\Response
     */
    public function edit(Traveler $traveler)
    {
        return view('admin.travelers.edit')
            ->withTraveler($traveler);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Traveler  $traveler
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Traveler $traveler)
    {
        $traveler->update($request->except(['_token', '_method']));

        return redirect()->route('admin.travelers.show', $traveler);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Traveler  $traveler
     * @return \Illuminate\Http\Response
     */
    public function destroy(Traveler $traveler)
    {
        $traveler->delete();

        return redirect()->route('admin.travelers.index');
    }
}
