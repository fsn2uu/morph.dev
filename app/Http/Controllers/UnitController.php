<?php

namespace App\Http\Controllers;

use App\Models\Pic;
use App\Models\Unit;
use App\Models\RateClass;
use App\Models\RateTable;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $start_date = $request->start_date ?? null;
        $end_date = $request->end_date ?? null;
        $beds = $request->beds ?? null;
        $baths = $request->baths ?? null;
        $sleeps = $request->sleeps ?? null;
        $neighborhood = $request->neighborhood ?? null;
        $amenities = $request->amenities ?? null;
        
        $units = Unit::search($start_date, $end_date, $beds, $baths, $sleeps, $amenities)->paginate(20);

        return view('admin.units.index', ['units' => $units]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.units.create', [
            'rate_tables' => RateTable::all(),
        ]);
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

        $request->merge(['slug' => Str::slug($request->name, '-')]);

        $unit =  new Unit;
            $unit->name = $request->name;
            $unit->status = $request->status;
            $unit->neighborhood_id = $request->neighborhood_id;
            $unit->address = $request->address;
            $unit->address2 = $request->address2;
            $unit->city = $request->city;
            $unit->state = $request->state;
            $unit->zip = $request->zip;
            $unit->beds = $request->beds;
            $unit->baths = $request->baths;
            $unit->sleeps = $request->sleeps;
            $unit->description = strip_tags($request->description, '<p><b><i>');
            $unit->company_id = $request->company_id;
            $unit->slug = $request->slug;
        $unit->save();

        if($request->has('pics'))
        {
            foreach($request->pics as $pic)
            {
                $name = $pic->getClientOriginalName();
                $extension = $pic->getClientOriginalExtension();

                $path = Storage::putFileAs(
                    'units/'.$unit->id, $pic, $name, 'public'
                );

                $picModel = new Pic([
                    'company_id' => Auth::user()->company_id,
                    'filename' => 'storage/'.$path,
                    'order' => 0,
                    'alt' => 'Picture of ' . $unit->name,
                    'title' => 'Picture of ' . $unit->name,
                ]);
                $unit->pics()->save($picModel);
            }
        }

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

        $reservations = $unit->reservations;

        if($unit->company_id == Auth::user()->company_id)
        {
            return view('admin.units.edit')
                ->withUnit($unit)
                ->withReservations($reservations);
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

        $request->merge(['description' => strip_tags($request->description, '<p><b><i>')]);

        $unit->update($request->except(['_token', 'pics', 'existing_pics']));

        if($request->has('existing_pics'))
        {
            //dd($request);
            foreach($request->existing_pics as $k => $v)
            {
                $pic = Pic::find($k);
                $pic->update([
                    'order' => $v['order'],
                    'alt' => $v['alt'],
                    'description' => $v['description'],
                ]);
            }
        }

        if($request->has('pics'))
        {
            foreach($request->pics as $pic)
            {
                $name = $pic->getClientOriginalName();
                $extension = $pic->getClientOriginalExtension();

                $path = Storage::putFileAs(
                    'units/'.$unit->id, $pic, $name, 'public'
                );

                $picModel = new Pic([
                    'company_id' => Auth::user()->company_id,
                    'filename' => 'storage/'.$path,
                    'order' => 0,
                    'alt' => 'Picture of ' . $unit->name,
                    'title' => 'Picture of ' . $unit->name,
                ]);
                $unit->pics()->save($picModel);
            }
        }

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
