<form action="{{ $verb == 'Create' ? route('admin.fees.store') : route('admin.fees.update', $fee) }}" method="post">
    @csrf
    <div>
        <label for="name" class="block font-medium text-gray-700">Fee Name</label>
        <input type="text" name="name" id="name" value="{{ old('name') ?: (@$fee->name ?: '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        @error('name')
            <span class="text-red-400">{{ $message }}</span>
        @enderror
    </div>
    <div>
        <label for="amount" class="block font-medium text-gray-700">Dollar Amount</label>
        <input type="text" name="amount" id="amount" value="{{ old('amount') ?: (@$fee->amount ?: '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        @error('amount')
            <span class="text-red-400">{{ $message }}</span>
        @enderror
    </div>
    <div>
        <label for="percentage" class="block font-medium text-gray-700">Percentage</label>
        <input type="text" name="percentage" id="percentage" value="{{ old('percentage') ?: (@$fee->percentage ?: '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        @error('percentage')
            <span class="text-red-400">{{ $message }}</span>
        @enderror
    </div>
    <div>
        <label for="attachment" class="block">Attach To</label>
        <select id="attachment" class="shadow appearance-none border border-[#ccc] mb-4 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
            <option value="">Select an Attachment</option>
            <option {{ @$fee->feeable_type === 'App\Models\Unit' ? 'checked' : '' }}>Unit</option>
            <option {{ @$fee->feeable_type === 'App\Models\Neighborhood' ? 'checked' : '' }}>Neighborhood</option>
            <option {{ @$fee->feeable_type === 'App\Models\Company' ? 'checked' : '' }}>Company</option>
        </select>
    </div>
    <div id="target"></div>
    <input type="submit" value="{{ $verb }}" class="bg-gold mx-auto mt-5 md:mx-0 hover:bg-darkGold text-black hover:text-white py-3 px-4 decoration-0 flex-nowrap">
</form>

@push('scripts')
    <script>
        document.getElementById('attachment').addEventListener('change', function() {
            var targetDiv = document.getElementById('target');
            var attachmentValue = this.value;

            // Clear the target div if attachment is empty
            if (attachmentValue === '') {
                targetDiv.innerHTML = '';
                return;
            }

            // Load content based on the attachment value
            if (attachmentValue === 'Unit') {
                var units = {!! $units !!}

                var checkboxesHTML = units.map(function(unit) {
                    return `
                        <div>
                            <input type="checkbox" id="unit-${unit.id}" name="units[]" value="${unit.id}">
                            <label for="unit-${unit.id}" class="">
                                ${unit.name}
                            </label>
                        </div>
                    `;
                }).join('');

                targetDiv.innerHTML = `
                    <div class="grid grid-cols-4 gap-4">
                        ${checkboxesHTML}
                    </div>
                `;
            } else if (attachmentValue === 'Neighborhood') {
                var neighborhoods = {!! $neighborhoods !!}

                var checkboxesHTML = neighborhoods.map(function(neighborhood) {
                    return `
                        <div>
                            <input type="checkbox" id="neighborhood-${neighborhood.id}" name="neighborhoods[]" value="${neighborhood.id}">
                            <label for="neighborhood-${neighborhood.id}" class="">
                                ${neighborhood.name}
                            </label>
                        </div>
                    `;
                }).join('');

                targetDiv.innerHTML = `
                    <div class="grid grid-cols-4 gap-4">
                        ${checkboxesHTML}
                    </div>
                `;
            } else if (attachmentValue === 'Company') {
                var hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'company_id';
                hiddenInput.value = {!! Auth::user()->company->id !!};
                targetDiv.innerHTML = ''; // Clear previous content
                targetDiv.appendChild(hiddenInput);
            }
        });
    </script>
@endpush