@extends('_template')

@section('content')

    <section id="content-body" class="md:w-[65%] md:mx-auto py-10 px-10 md:px-0 min-h-[60vh]">
        <div class="flex justify-between">
            <h1 class="text-contrastGold text-5xl mb-4">Create a Reservation</h1>
            <div class="items-end">
            </div>
        </div>

        <form action="{{ route('admin.reservations.store') }}" method="post">
            @csrf

            @php
                $fields = [
                    'company_id' => ['type' => 'text', 'required' => true],
                    'unit_id' => ['type' => 'text', 'required' => true],
                    'traveler_id' => ['type' => 'text', 'required' => true],
                    'status' => ['type' => 'text', 'required' => true],
                    'type' => ['type' => 'text', 'required' => true],
                    'amount_charged' => ['type' => 'text', 'required' => true],
                    'stripe_charge_id' => ['type' => 'text', 'required' => true],
                    'stripe_fees' => ['type' => 'text', 'required' => true],
                    'start_date' => ['type' => 'text', 'required' => true],
                    'end_date' => ['type' => 'text', 'required' => true],
                ];
            @endphp

            <label for="unit_id"  class="block">Unit</label>
            <select name="unit_id" id="unit_id" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                <option value="">Choose a Unit</option>
                @foreach ($units as $unit)
                    <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                @endforeach
            </select>

            <label for="traveler_id"  class="block">Traveler</label>
            <select name="traveler_id" id="traveler_id" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                <option value="">Choose a Traveler</option>
                @foreach ($travelers as $traveler)
                    <option value="{{ $traveler->id }}">{{ $traveler->last }}, {{ $traveler->first }}</option>
                @endforeach
                <option value="NEW">Create a New Traveler</option>
            </select>

            <label for="type"  class="block">Type of Reservation</label>
            <select name="type" id="type" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                <option value=""></option>
                <option value="to">Traveler Occupied</option>
                <option value="oo">Owner Occupied</option>
                <option value="m">Maintenance</option>
                <option value="b">Blackout</option>
            </select>

            <div class="grid grid-cols-1 md:grid-cols-2">
                <div class="md:pr-2">
                    <label for="start_date" class="block">Start Date</label>
                    <input type="text" name="start_date" id="start_date" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="md:pl-2">
                    <label for="end_date" class="block">End Date</label>
                    <input type="text" name="end_date" id="end_date" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                </div>
            </div>

            <input type="submit" value="Create" class="bg-gold mx-auto mt-5 md:mx-0 hover:bg-darkGold text-black hover:text-white py-3 px-4 decoration-0 flex-nowrap">
        </form>
    </section>

@endsection