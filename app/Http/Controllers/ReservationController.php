<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Stripe\Account;
use App\Models\Rate;
use App\Models\Unit;
use App\Models\Traveler;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(), [
            'unit_id' => 'required',
            'type' => 'required',
            'number' => 'required_if:type,to,The number field is required when type is `Traveler Occupied`.',
            'exp_month' => 'required_if:type,to,The expiration month field is required when type is `Traveler Occupied`.',
            'exp_year' => 'required_if:type,to,The expiration year field is required when type is `Traveler Occupied`.',
            'cvc' => 'required_if:type,to,The CVC field is required when type is `Traveler Occupied`.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }


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
        elseif ($request->has('traveler_id'))
        {
            $traveler = Traveler::find($request->traveler_id);
        }

        $unit = Unit::find($request->unit_id);

        //calculate the rental fee
        //we'll get the rate regardless of the rental type so that we can calculate how much is lost by anything other than travelers
        if($unit->rate_table):
            $table = $unit->rate_table;
        elseif($unit->rate_class->rate_table):
            $table = $unit->rate_class->table;
        elseif($unit->neighborhood->rate_table):
            $table = $unit->neighborhood->rate_table;
        elseif(Auth::user()->company->rate_table):
            $table = Auth::user()->company->rate_table;
        else:
            //die with an error.
        endif;
        $rate = Rate::where('rate_table_id', $table->id)
            ->where('start_date', '<=', Carbon::parse($request->end_date)->format('Y-m-d'))
            ->where('end_date', '>=', Carbon::parse($request->start_date)->format('Y-m-d'))
            ->first();

        $strt = Carbon::parse($request->start_date);
        $nd = Carbon::parse($request->end_date);
        $stay_length = $strt->diffInDays($nd);

        $rental_fee = $stay_length * $rate->amount;

        //WE ONLY WANT TO CREATE A CHARGE & TRANSFER IF THE TYPE IS `TO`
        if($request->type == 'to'):
            //ALL OF THIS STRIPE CODE NEEDS TO BE MOVED TO A SERVICE AFTER TESTING
            $stripe = new \Stripe\StripeClient(
                env('STRIPE_SECRET')
            );
            
            //token
            $token = $stripe->tokens->create([
                'card' => [
                    'number' => $request->number,
                    'exp_month' => $request->exp_month,
                    'exp_year' => $request->exp_year,
                    'cvc' => $request->cvc,
                ],
            ]);
    
            //charge
            $charge = $stripe->charges->create([
                'amount' => $rental_fee,
                'currency' => 'usd',
                'source' => $token['id'],
                'description' => "$traveler->first, $traveler->last - Reservation",
            ]);

            $request->merge(['stripe_charge_id' => $charge->id]);
            $request->merge(['amount_charged' => $rental_fee]);
    
            //transfer
            $transfee = ($rental_fee * .0029) + .30;
    
            $stripe->transfers->create([
                'amount' => floor($rental_fee - $transfee),
                'currency' => 'usd',
                'destination' => Auth::user()->company->stripe_account_id,
                'description' => "Transfer from CYSY - $traveler->first, $traveler->last - Reservation",
                'source_transaction' => $charge->id,
            ]);
    
            $request->request->remove('number');
            $request->request->remove('exp_year');
            $request->request->remove('exp_month');
            $request->request->remove('cvc');
        endif;

        $new_start_date = \Carbon\Carbon::parse($request->start_date)->format('Y-m-d');
        $new_end_date = \Carbon\Carbon::parse($request->end_date)->format('Y-m-d');
        $request->merge(['start_date' => $new_start_date, 'end_date' => $new_end_date]);

        $request->merge(['company_id' => Auth::user()->company_id]);

        $request->merge(['status' => 'paid']);

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
