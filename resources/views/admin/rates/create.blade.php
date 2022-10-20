@extends('_template')

@section('content')

    <section id="content-body" class="md:w-[65%] md:mx-auto py-10 px-10 md:px-0 min-h-[60vh]">
        <div class="flex justify-between">
            <h1 class="text-contrastGold text-5xl mb-4">Create a Rate Table</h1>
            <div class="items-end">
            </div>
        </div>

        <p class="mb-5">
            Rates will be selected using a "trickle-down" method.  The system will first look for a rate table attached to the unit, 
            then will look for one attached to the neighborhood, and finally fall back to one attached to your company.  The system 
            always looks in this order, so if you want all of your units to have the same rates, it's best to attach them to the company 
            and use individual rate tables on units to override the rates as needed.
        </p>

        <p class="mb-5">
            If you have no rate tables, the reservation will not complete, however, if you have multiple tables attached to the same id, 
            the newest table will be used.
        </p>

        <form action="{{ route('admin.rates.store') }}" method="post">
            @csrf
            <label for="name" class="block">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
            @error('name')
                <span class="text-red-400">{{ $message }}</span>
            @enderror
            <label for="attach_to" class="block">Attach To</label>
            <select id="attach_to" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                <option value=""></option>
                <option value="Company">Company</option>
                <option value="Neighborhood">Neighborhood</option>
                <option value="Unit">Unit</option>
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
        function row_creator(random)
        {
            const wrapper = document.createElement('div')
            wrapper.setAttribute('id', random)

            const grid = document.createElement('div')
            grid.setAttribute('class', 'grid grid-cols-1 md:grid-cols-5 gap-5 mb-5')

            const grid1 = document.createElement('div')
            const label_input1 = document.createElement('input')
            label_input1.setAttribute('type', 'text')
            label_input1.setAttribute('class', 'shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline')
            label_input1.setAttribute('name', 'rates['+random+'][\'label\']')
            grid1.appendChild(label_input1)
            grid.appendChild(grid1)

            const grid2 = document.createElement('div')
            const label_input2 = document.createElement('input')
            label_input2.setAttribute('type', 'text')
            label_input2.setAttribute('class', 'shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline')
            label_input2.setAttribute('name', 'rates['+random+'][\'start_date\']')
            grid2.appendChild(label_input2)
            grid.appendChild(grid2)

            const grid3 = document.createElement('div')
            const label_input3 = document.createElement('input')
            label_input3.setAttribute('type', 'text')
            label_input3.setAttribute('class', 'shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline')
            label_input3.setAttribute('name', 'rates['+random+'][\'end_date\']')
            grid3.appendChild(label_input3)
            grid.appendChild(grid3)

            const grid4 = document.createElement('div')
            const label_input4 = document.createElement('input')
            label_input4.setAttribute('type', 'text')
            label_input4.setAttribute('class', 'shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline')
            label_input4.setAttribute('name', 'rates['+random+'][\'amount\']')
            label_input4.setAttribute('placeholder', '10000 = $100.00')
            grid4.appendChild(label_input4)
            grid.appendChild(grid4)

            const grid5 = document.createElement('div')
            const butt = document.createElement('a')
            butt.setAttribute('class', 'bg-red-400 mx-auto mt-5 md:mx-0 hover:bg-red-600 text-black hover:text-white py-3 px-4 decoration-0 flex-nowrap')
            const icon = document.createElement('i')
            icon.setAttribute('class', "fa-solid fa-trash")
            butt.appendChild(icon)
            grid5.appendChild(butt)
            grid.appendChild(grid5)

            wrapper.appendChild(grid)

            return wrapper
        }

        function getRandomInteger(min = 2468, max = 91884461118164311)
        {
            return Math.floor(Math.random() * (max - min) ) + min;
        }

        const rate_container = document.getElementById('rate_container')

        rate_container.appendChild(row_creator(getRandomInteger()))

        const adder = document.getElementById('adder')
        adder.addEventListener('click', function(e){
            e.preventDefault();
            rate_container.appendChild(row_creator(getRandomInteger()))
        })

        const units = {!! $units !!}
        const neighborhoods = {!! $neighborhoods !!}
        const attach_to = document.getElementById('attach_to')
        attach_to.addEventListener('change', function(){
            if(this.value === 'Company')
            {
                if(document.contains(document.getElementById('units_wrapper')))
                {
                    document.getElementById('units_wrapper').remove()
                }
                if(document.contains(document.getElementById('neighborhoods_wrapper')))
                {
                    document.getElementById('neighborhoods_wrapper').remove()
                }
            }
            else if(this.value === 'Neighborhood')
            {
                if(document.contains(document.getElementById('units_wrapper')))
                {
                    document.getElementById('units_wrapper').remove()
                }
                const neighborhoods_wrapper = document.createElement('div')
                neighborhoods_wrapper.setAttribute('id', 'neighborhoods_wrapper')
                const neighborhoods_label = document.createElement('label')
                neighborhoods_label.setAttribute('class', 'block')
                neighborhoods_label.innerHTML = 'Select a Neighborhood'
                const neighborhoods_selector = document.createElement('select')
                neighborhoods_selector.setAttribute('name', 'neighborhood_id')
                neighborhoods_selector.setAttribute('class', 'shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline')
                neighborhoods_selector.appendChild(document.createElement('option'))
                neighborhoods.forEach(element => {
                    let opt = document.createElement('option')
                    opt.setAttribute('value', element.id)
                    opt.innerHTML = element.name
                    neighborhoods_selector.appendChild(opt)
                });
                neighborhoods_wrapper.appendChild(neighborhoods_label).appendChild(neighborhoods_selector)
                attach_to.after(neighborhoods_wrapper)
            }
            else if(this.value === 'Unit')
            {
                if(document.contains(document.getElementById('neighborhoods_wrapper')))
                {
                    document.getElementById('neighborhoods_wrapper').remove()
                }
                const units_wrapper = document.createElement('div')
                units_wrapper.setAttribute('id', 'units_wrapper')
                const units_label = document.createElement('label')
                units_label.setAttribute('class', 'block')
                units_label.innerHTML = 'Select a Unit'
                const units_selector = document.createElement('select')
                units_selector.setAttribute('name', 'neighborhood_id')
                units_selector.setAttribute('class', 'shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline')
                units_selector.appendChild(document.createElement('option'))
                units.forEach(element => {
                    let opt = document.createElement('option')
                    opt.setAttribute('value', element.id)
                    opt.innerHTML = element.name
                    units_selector.appendChild(opt)
                });
                units_wrapper.appendChild(units_label).appendChild(units_selector)
                attach_to.after(units_wrapper)
            }
        })
    </script>
    
@endpush