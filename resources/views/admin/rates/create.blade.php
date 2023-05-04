@extends('_template')

@section('content')

    <section id="content-body" class="md:w-[65%] md:mx-auto py-10 px-10 md:px-0 min-h-[60vh]">
        <div class="flex justify-between">
            <h1 class="text-contrastGold text-5xl mb-4">Create a Rate Table</h1>
            <div class="items-end">
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6 mb-10">
            <p class="mb-5">
                Rates will be selected using a "trickle-down" method.  The system will first look for a rate table attached to the unit, 
                then will look for one attached to the neighborhood, and finally fall back to one attached to your company.  The system 
                always looks in this order, so if you want all of your units to have the same rates, it's best to attach them to the company 
                and use individual rate tables on units to override the rates as needed.
            </p>
    
            <p class="mb-5">Rate tables can be attached to multiple units or neighborhoods, however, each unit or neighborhood can only have one rate table.</p>
    
            <p class="mb-5">
                If you have no rate tables, the reservation will not complete, however, if you have multiple tables attached to the same id, 
                the newest table will be used.
            </p>
    
            <form action="{{ route('admin.rates.store') }}" method="post">
                @csrf
                <div>
                    <label for="name" class="block font-medium text-gray-700">Rate Table Name</label>
                    <input type="text" name="name" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
            
                <!-- Rate Table Rows -->
                <div id="rate-table-rows">
                    <div class="mt-4">
                        <label class="block font-medium text-gray-700">Rate Table Rows</label>
            
                        <div class="mt-2 space-y-4 mb-5">
                            <div class="flex items-center space-x-4 gap-4">
                                <input type="text" name="titles[]" placeholder="Title" class="w-1/4 block rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <input type="date" name="start_dates[]" class="w-1/4 block rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <input type="date" name="end_dates[]" class="w-1/4 block rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <input type="text" name="amounts[]" placeholder="Amount" class="w-1/4 block rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <button type="button" class="ml-2 text-red-500 focus:outline-none" onclick="removeRow(this)">
                                    Remove
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            
                <!-- Add/Remove Row Buttons -->
                <div class="mt-4 flex justify-end">
                    <button type="button" class="bg-green-500 text-white px-4 py-2 rounded-md" onclick="addRow()">
                        Add Row
                    </button>
                    <button type="button" class="bg-red-500 text-white px-4 py-2 rounded-md ml-4" onclick="removeLastRow()">
                        Remove Last Row
                    </button>
                </div>

                <div class="mt-4">
                    <h2 class="text-contrastGold text-2xl mb-4">Attach Units</h2>
                    <div class="grid grid-cols-4 gap-4">
                        @foreach($units as $unit)
                            <div>
                                <input type="checkbox" id="unit-{{ $unit->id }}" name="units[]" value="{{ $unit->id }}">
                                <label for="unit-{{ $unit->id }}" class="">
                                    {{ $unit->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="mt-4">
                    <h2 class="text-contrastGold text-2xl mb-4">Attach Neighborhoods</h2>
                    <div class="grid grid-cols-4 gap-4">
                        @foreach($neighborhoods as $neighborhood)
                            <div>
                                <input type="checkbox" id="neighborhood-{{ $neighborhood->id }}" name="neighborhoods[]" value="{{ $neighborhood->id }}">
                                <label for="neighborhood-{{ $neighborhood->id }}" class="">
                                    {{ $neighborhood->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
                
                
                <input type="submit" value="Create" class="bg-gold mx-auto mt-5 md:mx-0 hover:bg-darkGold text-black hover:text-white py-3 px-4 decoration-0 flex-nowrap">
            </form>
        </div>
    </section>
    
@endsection

@push('scripts')

    {{-- all of this needs to be broken off, simplified, and cleaned up --}}
    <script>
        function addRow() {
        const container = document.getElementById('rate-table-rows');
        const row = document.createElement('div');
        row.innerHTML = `
            <div class="flex items-center space-x-4 mb-5 gap-4">
                <input type="text" name="titles[]" placeholder="Title" class="w-1/4 block rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <input type="date" name="start_dates[]" class="w-1/4 block rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <input type="date" name="end_dates[]" class="w-1/4 block rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <input type="text" name="amounts[]" placeholder="Amount" class="w-1/4 block rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <button type="button" class="ml-2 text-red-500 focus:outline-none" onclick="removeRow(this)">
                    Remove
                </button>
            </div>
        `;
        container.appendChild(row);
    }

    function removeRow(button) {
        const row = button.parentNode;
        const container = row.parentNode;
        container.removeChild(row);
    }

    function removeLastRow() {
        const container = document.getElementById('rate-table-rows');
        const rows = container.getElementsByClassName('flex items-center space-x-4');
        if (rows.length > 1) {
            container.removeChild(rows[rows.length - 1]);
        }
    }
    </script>
    
@endpush