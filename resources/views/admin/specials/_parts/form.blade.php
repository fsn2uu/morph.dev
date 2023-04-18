<div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                <form method="POST" action="{{ $verb == 'Create' ? route('admin.specials.store') : route('admin.specials.update', $special) }}">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="name">
                            Name
                        </label>
                        <input value="{{ old('name') ?: (@$special->name ?:'') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" type="text" placeholder="Special Name" name="name">
                        @error('name')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="neighborhood_id" class="block text-gray-700 font-bold mb-2 capitalize">neighborhood</label>
                        <select name="neighborhood_id" id="neighborhood_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value=""></option>
                            @foreach ($neighborhoods as $neighborhood)
                                <option value="{{ $neighborhood->id }}" {{ old('neighborhood_id') == $neighborhood->id ? 'selected' : (@$special->neighborhood_id == $neighborhood->id ? 'selected' : '') }}>{{ $neighborhood->name }}</option>
                            @endforeach
                        </select>
                        @error('neighborhood_id')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="unit_id" class="block text-gray-700 font-bold mb-2">Unit</label>
                        <select name="unit_id" id="unit_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value=""></option>
                            @foreach ($units as $unit)
                                <option value="{{ $unit->id }}" {{ old('unit_id') == $unit->id ? 'selected' : (@$special->unit_id == $unit->id ? 'selected':'') }}>{{ $unit->name }}</option>
                            @endforeach
                        </select>
                        @error('unit_id')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="description">
                            Description
                        </label>
                        <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="description" type="text" placeholder="Special Description" name="description">{!! old('description')?: (@$special->description ?: '') !!}</textarea>
                        @error('description')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="type">
                            Type
                        </label>
                        <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="type" name="type">
                            <option value="fixed" {{ old('type') == "fixed" ? 'selected' : (@$special->type == "fixed" ? 'selected' : '') }}>Fixed</option>
                            <option value="percentage" {{ old('type') == "percentage" ? 'selected' : (@$special->type == "percentage" ? 'selected' : '') }}>Percentage</option>
                        </select>
                        @error('type')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="amount">
                            Amount
                        </label>
                        <input value="{{ old('amount') ?: (@$special->amount ?: '') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="amount" type="text" placeholder="Special Amount" name="amount">
                        @error('amount')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="start_date">
                            Start Date
                        </label>
                        <input value="{{ old('start_date') ?:(@$special->start_date ?: '') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="start_date" type="datetime-local" name="start_date">
                        @error('start_date')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="end_date">
                            End Date
                        </label>
                        <input value="{{ old('end_date')?:(@$special->end_date ?: '') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="end_date" type="datetime-local" name="end_date">
                        @error('end_date')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex items-center justify-start mt-4">
                        <button class="bg-gold mx-auto md:mx-0 hover:bg-darkGold text-black hover:text-white py-3 px-4 decoration-0 flex-nowrap" type="submit">
                            {{ $verb }} Special
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    const neighborhoodSelect = document.getElementById('neighborhood_id');
    const unitSelect = document.getElementById('unit_id');

    neighborhoodSelect.addEventListener('change', () => {
        if (unitSelect.value !== '') {
            unitSelect.value = '';
        }
    });

    unitSelect.addEventListener('change', () => {
        if (neighborhoodSelect.value !== '') {
            neighborhoodSelect.value = '';
        }
    });

    const amountField = document.getElementById('amount');

    amountField.addEventListener('keypress', function(event) {
        const key = event.key;

        // Allow only numbers and a single period
        if (!/[\d\.]/.test(key) || (key === '.' && amountField.value.includes('.'))) {
            event.preventDefault();
        }
    });

</script>

@endpush