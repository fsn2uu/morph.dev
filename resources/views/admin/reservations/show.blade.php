@extends('_template')

@section('content')

    <section id="content-body" class="md:w-[65%] md:mx-auto py-10 px-10 md:px-0 min-h-[60vh]">
        <div class="flex justify-between">
            <h1 class="text-contrastGold text-5xl mb-4">Reservation - {{ $reservation->type == 'to' ? "{$reservation->traveler->first} {$reservation->traveler->last}" : ($reservation->type == 'oo' ? 'Owner Occupied' : '') }}</h1>
            <div class="items-end">
            </div>
        </div>
        Amount Charged: ${{ $reservation->amount_charged*.01 }}
    </section>

@endsection