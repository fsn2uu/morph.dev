<?php

namespace App\Http\Controllers;

use App\Models\Rate;
use App\Models\Unit;
use App\Models\RateTable;
use App\Models\Neighborhood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.rates.index', 
            [
                'rate_tables' => RateTable::all(),
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $neighborhoods = Neighborhood::all();
        $units = Unit::all();

        return view("admin.rates.create")
            ->withNeighborhoods($neighborhoods)
            ->withUnits($units);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'titles' => 'required|array',
            'start_dates' => 'required|array',
            'end_dates' => 'required|array',
            'amounts' => 'required|array',
        ]);
    
        $rateTable = RateTable::create([
            'name' => $validatedData['name'],
            'company_id' => Auth::user()->company->id,
        ]);
    
        for ($i = 0; $i < count($validatedData['titles']); $i++) {
            $rateTable->rates()->create([
                'name' => $validatedData['titles'][$i],
                'start_date' => $validatedData['start_dates'][$i],
                'end_date' => $validatedData['end_dates'][$i],
                'amount' => $validatedData['amounts'][$i],
            ]);
        }

        if($request->has('neighborhoods'))
        {
            foreach($request->neighborhoods as $neighborhood)
            {
                $neighborhood = Neighborhood::find($neighborhood);
                $neighborhood->rateTable()->associate($rateTable);
                $neighborhood->save();
            }
        }

        if($request->has('units'))
        {
            foreach($request->units as $unit)
            {
                $unit = Unit::find($unit);
                $unit->rateTable()->associate($rateTable);
                $unit->save();
            }
        }

        session()->flash('toasts', [
            [
                'title' => '',
                'message' => 'Rate table successfully created!',
            ]
        ]);

        return redirect()->route('admin.rates.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->route('admin.rates.edit', $id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rate_table = RateTable::find($id);
        $neighborhoods = Neighborhood::all()->toJson();
        $units = Unit::all()->toJson();
        $rates = $rate_table->rates->toJson();
        
        return view('admin.rates.edit', [
            'rate_table' => $rate_table,
            'units' => $units,
            'neighborhoods' => $neighborhoods,
            'rates' => $rates,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
