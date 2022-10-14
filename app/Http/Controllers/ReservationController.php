<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Traveler;
use App\Models\Unit;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservations = Reservation::all();

        return view('admin.reservations.index')
            ->withReservations($reservations);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $units = Unit::all();
        $travelers = Traveler::all();

        return view('admin.reservations.create')
            ->withUnits($units)
            ->withTravelers($travelers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->has('traveler'))
        {
            $traveler = Traveler::updateOrCreate(
                [
                    'email' => $request->traveler['email'],
                ],
                [
                    'first' => $request->traveler['first'],
                    'last' => $request->traveler['last'],
                    'phone' => $request->traveler['phone'],
                    'address' => $request->traveler['address'],
                    'city' => $request->traveler['city'],
                    'state' => $request->traveler['state'],
                    'zip' => $request->traveler['zip'],
                ]
            );

            $request->merge(['traveler_id', $traveler->id]);
        }

        $reservation = Reservation::create($request->except(['_token', '_method', 'traveler']));

        return redirect()->route('admin.reservations.show', $reservation);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation)
    {
        return view('admin.reservations.show')
            ->withReservation($reservation);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
        return view('admin.reservations.edit')
            ->withReservation($reservation);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservation $reservation)
    {
        $reservation->update($request->except(['_token', '_method']));

        return redirect()->route('admin.reservations.show', $reservation);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        return redirect()->route('admin.reservations.index');
    }
}
