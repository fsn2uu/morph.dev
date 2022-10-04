<?php

namespace App\Http\Controllers;

use App\Models\Neighborhood;
use Illuminate\Http\Request;
use App\Http\Resources\NeighborhoodResource;

class NeighborhoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.neighborhoods.index', ['neighborhoods' => Neighborhood::paginate(20)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.neighborhoods.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $neighborhood = Neighborhood::create($request->except(['_token', 'pics']));

        return redirect()->route('admin.neighborhoods.show', $neighborhood->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Neighborhood  $neighborhood
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        return redirect()->route('admin.neighborhoods.edit', $slug);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Neighborhood  $neighborhood
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $neighborhood = Neighborhood::where('slug', $slug)->firstOrFail();

        return view('admin.neighborhoods.edit', ['neighborhood' => $neighborhood]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Neighborhood  $neighborhood
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $neighborhood = Neighborhood::where('slug', $slug)->firstOrFail();

        $neighborhood->update($request->except(['_token', '_method', 'pics']));

        return redirect()->route('admin.neighborhoods.show', $neighborhood->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Neighborhood  $neighborhood
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        Neighborhood::where('slug', $slug)->delete();

        return redirect()->route('admin.neighborhoods.index');
    }
}
