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

    <script>
        $(function(){
            $('.date').datepicker()
        })
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