<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.units.index', ['units' => Unit::where('company_id', Auth::user()->company_id)->paginate(20)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.units.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->merge(['company_id' => Auth::user()->company_id]);

        $request->merge(['slug' => Str::of($request->name)->slug('-')]);

        $unit =  Unit::create($request->except(['_token']));

        return redirect()->route("admin.units.edit", $unit->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        return redirect()->route('admin.units.edit', $slug);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $unit = Unit::where('slug', $slug)->firstOrFail();

        if($unit->company_id == Auth::user()->company_id)
        {
            return view('admin.units.edit')
                ->withUnit($unit);
        }
        else
        {
            abort(401);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $unit = Unit::where('slug', $slug)->firstOrFail();
        
        $request->merge(['slug' => Str::of($request->name)->slug('-')]);

        $unit->update($request->except(['_token']));

        return redirect()->route('admin.units.edit', $unit->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        Unit::where('slug', $slug)->delete();

        return redirect()->route('admin.units.index');
    }
}
