<?php

namespace App\Http\Controllers;

use App\Models\Fee;
use App\Models\Unit;
use App\Models\Neighborhood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fees = Fee::all();

        return view('admin.fees.index')
            ->withFees($fees);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $units = Unit::all()->toJson();
        $neighborhoods = Neighborhood::all()->toJson();

        return view('admin.fees.create')
            ->withUnits($units)
            ->withNeighborhoods($neighborhoods);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'percentage' => 'required_without:amount',
            'amount' => 'required_without:percentage',
            'units' => 'required_without_all:neighborhoods,company_id|array',
            'neighborhoods' => 'required_without_all:units,company_id|array',
            'company_id' => 'required_without_all:units,neighborhoods',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $feeModel = new Fee([
            'name' => $request->name,
            'percentage' => $request->percentage ?? null,
            'amount' => $request->amount ?? null,
        ]);

        if($request->has('company_id'))
        {
            Auth::user()->company->fees()->save($feeModel);
        }
        elseif($request->has('units'))
        {
            foreach($request->units as $unit)
            {
                $feeModel = new Fee([
                    'name' => $request->name,
                    'percentage' => $request->percentage ?? null,
                    'amount' => $request->amount ?? null,
                ]);
                Unit::find($unit)->fees()->save($feeModel);
            }
        }
        elseif($request->has('neighborhoods'))
        {
            foreach($request->neighborhoods as $neighborhood)
            {
                $feeModel = new Fee([
                    'name' => $request->name,
                    'percentage' => $request->percentage ?? null,
                    'amount' => $request->amount ?? null,
                ]);
                Neighborhood::find($neighborhood)->fees()->save($feeModel);
            }
        }

        session()->flash('toasts', [
            [
                'title' => '',
                'message' => 'Fee Created',
            ]
        ]);

        return redirect()->route('admin.fees.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Fee $fee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fee $fee)
    {        
        $units = Unit::all()->toJson();
        $neighborhoods = Neighborhood::all()->toJson();

        return view('admin.fees.create')
            ->withUnits($units)
            ->withNeighborhoods($neighborhoods)
            ->withFee($fee);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fee $fee)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'percentage' => 'required_without:amount',
            'amount' => 'required_without:percentage',
            'units' => 'required_without_all:neighborhoods,company_id|array',
            'neighborhoods' => 'required_without_all:units,company_id|array',
            'company_id' => 'required_without_all:units,neighborhoods',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $feeModel = $fee->update([
            'name' => $request->name,
            'percentage' => $request->percentage ?? null,
            'amount' => $request->amount ?? null,
        ]);

        if($request->has('company_id'))
        {
            Auth::user()->company->fees()->save($feeModel);
        }
        elseif($request->has('units'))
        {
            foreach($request->units as $unit)
            {
                $feeModel = $fee->update([
                    'name' => $request->name,
                    'percentage' => $request->percentage ?? null,
                    'amount' => $request->amount ?? null,
                ]);
                Unit::find($unit)->fees()->save($feeModel);
            }
        }
        elseif($request->has('neighborhoods'))
        {
            foreach($request->neighborhoods as $neighborhood)
            {
                $feeModel = $fee->update([
                    'name' => $request->name,
                    'percentage' => $request->percentage ?? null,
                    'amount' => $request->amount ?? null,
                ]);
                Neighborhood::find($neighborhood)->fees()->save($feeModel);
            }
        }

        return redirect()->route('admin.fees.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fee $fee)
    {
        $fee->delete();

        return redirect()->route('admin.fees.index');
    }
}
