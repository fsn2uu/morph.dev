<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rate;
use App\Models\RateTable;
use App\Models\Neighborhood;
use App\Models\Unit;
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
        $rate_tables = RateTable::all();

        return view('admin.rates.index', ['rate_tables' => $rate_tables]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $neighborhoods = Neighborhood::all()->toJson();
        $units = Unit::all()->toJson();

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
        $rate_table = RateTable::create([
            'name' => $request->name,
            'company_id' => Auth::user()->company->id,
            'neighborhood_id' => $request->neighborhood_id ?: null,
            'unit_id' => $request->unit_id ?: null,
        ]);

        if($request->has('rates'))
        {
            foreach ($request->rates as $key => $rate) {
                Rate::create([
                    'rate_table_id' => $rate_table->id,
                    'name' => $rate['label'],
                    'start_date' => \Carbon\Carbon::parse($rate['start_date'])->format('Y-m-d'),
                    'end_date' => \Carbon\Carbon::parse($rate['end_date'])->format('Y-m-d'),
                    'amount' => $rate['amount'],
                ]);
            }
        }

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
        
        return view('admin.rates.edit', [
            'rate_table' => $rate_table,
            'units' => $units,
            'neighborhoods' => $neighborhoods,
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
