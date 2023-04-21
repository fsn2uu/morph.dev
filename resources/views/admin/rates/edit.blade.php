@extends('_template')

@section('content')

    <section id="content-body" class="md:w-[65%] md:mx-auto py-10 px-10 md:px-0 min-h-[60vh]">
        <div class="flex justify-between">
            <h1 class="text-contrastGold text-5xl mb-4">Edit a Rate Table</h1>
            <div class="items-end">
            </div>
        </div>

        <form action="{{ route('admin.rates.update', $rate_table->id) }}" method="post">
            @csrf
            <label for="name" class="block">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name') ?: ($rate_table->name ? : '') }}" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
            @error('name')
                <span class="text-red-400">{{ $message }}</span>
            @enderror
            <label for="attach_to" class="block">Attach To</label>
            <select id="attach_to" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                <option value=""></option>
                <option value="Company" {{old('attach_to') == 'Company' ? 'selected' : ($rate_table->neighborhood_id == '' && $rate_table->unit_id == '' ? 'selected' : '')}}>Company</option>
                <option value="Neighborhood" {{old('attach_to') == 'Neighborhood' ? 'selected' : ($rate_table->neighborhood_id != '' ? 'selected' : '')}}>Neighborhood</option>
                <option value="Unit" {{old('attach_to') == 'Unit' ? 'selected' : ($rate_table->unit_id != '' ? 'selected' : '')}}>Unit</option>
            </select>
            
            
            <label for="" class="block mb-3">Rates</label>
            <div id="rate_container">
                <div class="grid grid-cols-5 gap-5">
                    <div>Label</div>
                    <div>Start Date</div>
                    <div>End Date</div>
                    <div>Amount</div>
                    <div></div>
                </div>
                
            </div>
            <div class="mb-5">
                <a href="#" id="adder" class="float-right bg-green-600 mx-auto mt-5 md:mx-0 hover:bg-green-800 text-black hover:text-white py-3 px-4 decoration-0 flex-nowrap">[+]</a>
            </div>
            
            
            <input type="submit" value="Create" class="bg-gold mx-auto mt-5 md:mx-0 hover:bg-darkGold text-black hover:text-white py-3 px-4 decoration-0 flex-nowrap">
        </form>
    </section>
    
@endsection

@push('scripts')

    {{-- all of this needs to be broken off, simplified, and cleaned up --}}
    <script>
        function row_creator(random, id, name, start_date, end_date, amount) {
            // create a div element and set its id attribute
            const wrapper = document.createElement('div')
            wrapper.id = random

            // create a div element with a class attribute and append it to the wrapper
            const grid = document.createElement('div')
            grid.className = 'grid grid-cols-1 md:grid-cols-5 gap-5 mb-5'
            wrapper.appendChild(grid)

            // create a function to generate a div element with an input element inside
            const createInputDiv = (name, id, value) => {
                const div = document.createElement('div')
                const input = document.createElement('input')
                input.type = 'text'
                input.className = 'shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline'
                input.name = (id ? `rates[${id}][${name}]` : `rates[${random}][${name}]`)
                if(value) input.value = value
                div.appendChild(input)
                return div
            }

            // create input divs for label, start_date, end_date, and amount
            const labelDiv = createInputDiv('label', id, name)
            const startDateDiv = createInputDiv('start_date', id, start_date)
            const endDateDiv = createInputDiv('end_date', id, end_date)
            const amountDiv = createInputDiv('amount', id, amount)
            amountDiv.children[0].placeholder = '10000 = $100.00' // set the placeholder for the amount input

            // create a delete button element and append it to a div element
            const deleteDiv = document.createElement('div')
            const deleteButton = document.createElement('a')
            deleteButton.className = 'bg-red-400 mx-auto mt-5 md:mx-0 hover:bg-red-600 text-black hover:text-white py-3 px-4 decoration-0 flex-nowrap'
            const deleteIcon = document.createElement('i')
            deleteIcon.className = 'fa-solid fa-trash'
            deleteButton.appendChild(deleteIcon)
            deleteDiv.appendChild(deleteButton)

            // append all the created div elements to the grid element
            grid.appendChild(labelDiv)
            grid.appendChild(startDateDiv)
            grid.appendChild(endDateDiv)
            grid.appendChild(amountDiv)
            grid.appendChild(deleteDiv)

            return wrapper
        }

        function getRandomInteger(min = 2468, max = 91884461118164311)
        {
            return Math.floor(Math.random() * (max - min) ) + min;
        }

        const rate_container = document.getElementById('rate_container')
        
        const adder = document.getElementById('adder')
        adder.addEventListener('click', function(e){
            e.preventDefault();
            rate_container.appendChild(row_creator(getRandomInteger()))
        })
        
        const rates = {!! $rates !!}
        createRowsOnPageLoad(rates)

        rate_container.appendChild(row_creator(getRandomInteger()))

        const units = {!! $units !!}
        const neighborhoods = {!! $neighborhoods !!}
        const attach_to = document.getElementById('attach_to')

        function createRowsOnPageLoad(rates) {
            const table = document.getElementById('attach_to');
            console.log(rates)
            rates.forEach(rate => {
                const row = row_creator(null, rate.id, rate.name, rate.start_date, rate.end_date, rate.amount);
                rate_container.appendChild(row);
            });
        }

        attach_to.addEventListener('change', function(){
            const units_wrapper = document.getElementById('units_wrapper')
            const neighborhoods_wrapper = document.getElementById('neighborhoods_wrapper')

            if(units_wrapper) units_wrapper.remove()
            if(neighborhoods_wrapper) neighborhoods_wrapper.remove()

            if(this.value === 'Neighborhood') {
                const neighborhoods_wrapper = createWrapper('neighborhoods_wrapper')
                createLabel(neighborhoods_wrapper, 'Select a Neighborhood')
                createSelector(neighborhoods_wrapper, neighborhoods, 'name', 'neighborhood_id')
                attach_to.after(neighborhoods_wrapper)
            } else if(this.value === 'Unit') {
                const units_wrapper = createWrapper('units_wrapper')
                createLabel(units_wrapper, 'Select a Unit')
                createSelector(units_wrapper, units, 'name', 'unit_id')
                attach_to.after(units_wrapper)
            }
        })

        function createWrapper(id) {
            const wrapper = document.createElement('div')
            wrapper.setAttribute('id', id)
            return wrapper
        }

        function createLabel(wrapper, text) {
            const label = document.createElement('label')
            label.setAttribute('class', 'block')
            label.innerHTML = text
            wrapper.appendChild(label)
        }

        function createSelector(wrapper, data, labelProp, valueProp) {
            const selector = document.createElement('select')
            selector.setAttribute('name', valueProp)
            selector.setAttribute('class', 'shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline')
            selector.appendChild(document.createElement('option'))

            data.forEach(element => {
                const opt = document.createElement('option')
                opt.setAttribute('value', element.id)
                opt.innerHTML = element[labelProp]
                selector.appendChild(opt)
            })

            wrapper.appendChild(selector)
        }

    </script>
    
@endpush