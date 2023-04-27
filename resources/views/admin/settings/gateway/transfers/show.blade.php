@extends('_template')

@section('content')

    <section id="content-body" class="md:w-[65%] md:mx-auto py-10 px-10 md:px-0 min-h-[60vh]">
        <div class="flex justify-between">
            <h1 class="text-contrastGold text-5xl mb-4">{{ $transfer->description }}</h1>
            <div class="items-end">
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6 mb-10">
            <p>A transfer in the amount of <span class="font-bold">${{ $transfer->amount / 100 }}</span> was created on <span class="font-bold">{{ \Carbon\Carbon::parse($transfer->created)->format('Y-m-d') }}</span>.</p>           
            @if ($reservation)
                <p>This transfer originated from a <a class="text-blue-400 underline" href="{{ route('admin.reservations.show', $reservation) }}">reservation created for {{ "{$reservation->traveler->first} {$reservation->traveler->last}" }} on {{ \Carbon\Carbon::parse($reservation->created_at)->format('Y-m-d') }}</a>.</p>
            @endif
            <p>This transfer was assigned ID <span class="font-bold">{{ $transfer->id }}</span></p>
        </div>
    </section>

@endsection