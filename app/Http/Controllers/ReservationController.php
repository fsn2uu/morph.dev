<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Traveler;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        //NEED TO VALIDATE THIS

        //MOVE TRAVELERS TO A SERVICE
        if($request->has('traveler'))
        {
            Traveler::updateOrCreate(
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
            
            $traveler = Traveler::where('email', $request->traveler['email'])->first();

            $request->merge(['traveler_id' => $traveler->id]);
            $request->request->remove('traveler');
        }

        //ALL OF THIS STRIPE CODE NEEDS TO BE MOVED TO A SERVICE AFTER TESTING
        $stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET')
        );

        //token
        $token = $stripe->tokens->create([
            'card' => [
                'number' => $request->payment['card_number'],
                'exp_month' => $request->payment['exp_month'],
                'exp_year' => $request->payment['exp_year'],
                'cvc' => $request->payment['cvc'],
            ],
        ]);
        //charge
        $charge = $stripe->charges->create([
            'amount' => $rentalfee,
            'currency' => 'usd',
            'source' => $token['id'],
            'description' => "$traveler->lname, $traveler->fname - Reservation",
        ]);
        //transfer
        $transfee = ($rentalfee * .0029) + .30;
        $stripe->transfers->create([
            'amount' => $rentalfee - $transfee,
            'currency' => 'usd',
            'destination' => Auth::user()->company->stripe_id,
        ]);

        $new_start_date = \Carbon\Carbon::parse($request->start_date)->format('Y-m-d');
        $new_end_date = \Carbon\Carbon::parse($request->end_date)->format('Y-m-d');
        $request->merge(['start_date' => $new_start_date, 'end_date' => $new_end_date]);

        $request->merge(['company_id' => Auth::user()->company_id]);

        $request->merge(['status' => 'pending payment']);

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
