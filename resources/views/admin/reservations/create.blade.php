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

            <label for="unit_id"  class="block">Unit</label>
            <select name="unit_id" id="unit_id" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                <option value="">Choose a Unit</option>
                @foreach ($units as $unit)
                    <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                @endforeach
            </select>

            <label for="type"  class="block">Type of Reservation</label>
            <select name="type" id="type" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                <option value=""></option>
                <option value="to">Traveler Occupied</option>
                <option value="oo">Owner Occupied</option>
                <option value="m">Maintenance</option>
                <option value="b">Blackout</option>
            </select>

            <div id="traveler_id_wrapper">
                <label for="traveler_id"  class="block">Traveler</label>
                <select name="traveler_id" id="traveler_id" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="">Choose a Traveler</option>
                    @foreach ($travelers as $traveler)
                        <option value="{{ $traveler->id }}">{{ $traveler->last }}, {{ $traveler->first }}</option>
                    @endforeach
                    <option value="NEW">Create a New Traveler</option>
                </select>
            </div>

            <div id="credit_card_wrapper">
                <label for="number" class="block mb-5">Credit Card Number <span class="text-red-400">*</span>
                    <input type="text" name="number" id="number" value="{{ old('number') }}" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                </label>
                @error('number')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    <label for="exp_year" class="block mb-5">Exp Year <span class="text-red-400">*</span>
                        <select name="exp_year" id="exp_year" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                            <option value=""></option>
                            @for ($i = date('Y'); $i < date('Y') + 10; $i++)
                                <option {{ old('exp_year') == $i ? 'selected' : '' }}>{{$i}}</option>
                            @endfor
                        </select>
                        @error('exp_year')
                            <span class="text-red-400">{{ $message }}</span>
                        @enderror
                    </label>
                    <label for="exp_month" class="block mb-5">Exp Month <span class="text-red-400">*</span>
                        <select name="exp_month" id="exp_month" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                            <option value=""></option>
                            @for ($i = 1; $i <= 12; $i++)
                                <option {{ old('exp_month') == $i ? 'selected' : '' }}>{{$i}}</option>
                            @endfor
                        </select>
                        @error('exp_month')
                            <span class="text-red-400">{{ $message }}</span>
                        @enderror
                    </label>
                    <label for="cvc" class="block mb-5">CVC Number <span class="text-red-400">*</span>
                        <input type="text" name="cvc" id="cvc" value="{{old('cvc')}}" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                        @error('cvc')
                            <span class="text-red-400">{{ $message }}</span>
                        @enderror
                    </label>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2">
                <div class="md:pr-2">
                    <label for="start_date" class="block">Start Date</label>
                    <input type="text" name="start_date" id="start_date" class="date shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="md:pl-2">
                    <label for="end_date" class="block">End Date</label>
                    <input type="text" name="end_date" id="end_date" class="date shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                </div>
            </div>

            <input type="submit" value="Create" class="bg-gold mx-auto mt-5 md:mx-0 hover:bg-darkGold text-black hover:text-white py-3 px-4 decoration-0 flex-nowrap">
        </form>
    </section>

@endsection

@push('head')

    {{-- need to replace this crap with a Vue component --}}

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>

    @php
        $reservedDates = ['2023-05-24', '2023-05-26'];
    @endphp

    <script>
        $(document).ready(function() {
            // Retrieve the minimum selectable date for arrival_date (today + 3 days)
            var minArrivalDate = new Date();
            minArrivalDate.setDate(minArrivalDate.getDate() + 3);

            // Fetch the reserved dates for the unit
            var reservedDates = {!! json_encode($reservedDates) !!};

            // Initialize the datepicker for arrival_date
            $('#start_date').datepicker({
                minDate: minArrivalDate,
                beforeShowDay: function(date) {
                var dateString = $.datepicker.formatDate('yy-mm-dd', date);

                // Check if the date is reserved
                if(reservedDates)
                {
                    var isReserved = reservedDates.includes(dateString);
                }

                return [!isReserved, isReserved ? 'bg-red-200' : ''];
                },
                onSelect: function(selectedDate) {
                // Retrieve the selected arrival_date
                var arrivalDate = $(this).datepicker('getDate');

                // Calculate the minimum selectable date for departure_date (arrival_date + 3 days)
                var minDepartureDate = new Date(arrivalDate);
                minDepartureDate.setDate(minDepartureDate.getDate() + 3);

                // Set the minimum selectable date for departure_date
                $('#end_date').datepicker('option', 'minDate', minDepartureDate);
                }
            });

            // Initialize the datepicker for departure_date
            $('#end_date').datepicker({
                beforeShowDay: function(date) {
                var dateString = $.datepicker.formatDate('yy-mm-dd', date);

                // Check if the date is reserved
                if(reservedDates)
                {
                    var isReserved = reservedDates.includes(dateString);
                }

                return [!isReserved, isReserved ? 'bg-red-200' : ''];
                }
            });
            });


    </script>
    
@endpush

@push('scripts')

    <script>
        const travelerType = document.getElementById('traveler_id')
        const wrapper = document.getElementById('traveler_id_wrapper')

        travelerType.addEventListener('change', function(){
            if(travelerType.value == 'NEW')
            {
                const travelerContainer = document.createElement("div", {id: "traveler_container"})
                const fields = [
                    'first',
                    'last',
                    'email',
                    'phone',
                    'address',
                    'city',
                    'state',
                    'zip'
                ]

                fields.forEach(k => {
                    let cont = document.createElement("div")
                    let label = document.createElement("label")
                    let input = document.createElement("input")

                    label.setAttribute('for', k)
                    label.innerHTML = "traveler " + k
                    label.setAttribute('class', 'capitalize block')

                    input.setAttribute('type', 'text')
                    input.setAttribute('name', "traveler["+k+"]")
                    input.setAttribute('id', k)
                    input.setAttribute('class', 'shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline')
                    
                    cont.appendChild(label)
                    cont.appendChild(input)
                    travelerContainer.appendChild(cont)
                });

                wrapper.after(travelerContainer)

                wrapper.remove()
            }
        })
    </script>
    
@endpush