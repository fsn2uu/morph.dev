<?php

namespace App\Http\Controllers\Settings\Gateway;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Services\StripeTransfers;
use App\Http\Controllers\Controller;

class TransferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(StripeTransfers $stripeTransfers)
    {
        $transfers = $stripeTransfers->list();

        return view('admin.settings.gateway.transfers.index')
            ->withTransfers($transfers);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, StripeTransfers $stripeTransfers)
    {
        $transfer = $stripeTransfers->retrieve($id);

        $reservation = Reservation::where('stripe_charge_id', $transfer->source_transaction)->first();

        return view('admin.settings.gateway.transfers.show')
            ->withTransfer($transfer)
            ->withReservation($reservation);
    }
}
