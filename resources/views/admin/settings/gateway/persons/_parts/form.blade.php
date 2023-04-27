<form action="{{ $verb == 'Update' ? route('admin.gateway.persons.update', $user) : route('admin.gateway.persons.create') }}" method="POST">
    @csrf
    @method('PATCH')
    <div>
        <label for="first_name" class="block capitalize">First Name</label>
        <input type="text" name="first_name" id="first_name" value="{{ @$person->first_name }}" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    <div>
        <label for="last_name" class="block capitalize">Last Name</label>
        <input type="text" name="last_name" id="last_name" value="{{ @$person->last_name }}" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    <div>
        <label for="line1" class="block capitalize">Address</label>
        <input type="text" name="line1" id="line1" value="{{ @$person->address->line1 }}" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    <div>
        <label for="line2" class="block capitalize">Address Line 2</label>
        <input type="text" name="line2" id="line2" value="{{ @$person->address->line2 }}" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    <div>
        <label for="city" class="block capitalize">City</label>
        <input type="text" name="city" id="city" value="{{ @$person->address->city }}" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    <div>
        <label for="state" class="block capitalize">state</label>
        <input type="text" name="state" id="state" value="{{ @$person->address->state }}" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    <div>
        <label for="postal_code" class="block capitalize">zip code</label>
        <input type="text" name="postal_code" id="postal_code" value="{{ @$person->address->postal_code }}" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    <div>
        <label for="email" class="block capitalize">Email</label>
        <input type="text" name="email" id="email" value="{{ @$person->email }}" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    <div>
        <label for="phone" class="block capitalize">phone</label>
        <input type="text" name="phone" id="phone" value="{{ @$person->phone }}" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    <div>
        <label for="id_number" class="block capitalize">SSN (or Government ID number)</label>
        <input type="text" name="id_number" id="id_number" value="{{ @$person->id_number }}" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    <div>
        <label for="ssn_last_4" class="block capitalize">SSN last 4</label>
        <input type="text" name="ssn_last_4" id="ssn_last_4" value="{{ @$person->ssn_last_4 }}" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    <div>
        <label for="dob" class="block capitalize">Date of Birth</label>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <div>
                <label for="dob_month" class="block capitalize">Month</label>
                <select name="dob[month]" id="dob_month" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                    @for ($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}" {{ $i==@$person->dob->month ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div>
                <label for="dob_day" class="block capitalize">day</label>
                <select name="dob[day]" id="dob_day" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                    @for ($i = 1; $i <= 31; $i++)
                        <option value="{{ $i }}" {{ $i==@$person->dob->day ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div>
                <label for="dob_year" class="block capitalize">year</label>
                <select name="dob[year]" id="dob_year" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                    @for ($i = 1900; $i <= \Carbon\Carbon::now()->subYears(15)->format('Y'); $i++)
                        <option value="{{ $i }}" {{ $i==@$person->dob->year ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </div>
        </div>
        <div>
            <label for="relationship" class="block capitalize">Relationship</label>
            <select name="relationship" id="relationship" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                <option {{ old('relationship') == 'Representative' ? 'selected' : (@$person->relationship->representative == true ? 'selected' : '') }}>Representative</option>
                <option {{ old('relationship') == 'Owner' ? 'selected' : (@$person->relationship->owner == true ? 'selected' : '') }}>Owner</option>
                <option {{ old('relationship') == 'Director' ? 'selected' : (@$person->relationship->director == true ? 'selected' : '') }}>Director</option>
                <option {{ old('relationship') == 'Executive' ? 'selected' : (@$person->relationship->executive == true ? 'selected' : '') }}>Executive</option>
                <option>Other</option>
            </select>
        </div>
    </div>
    <input type="submit" value="{{ $verb }}" class="bg-gold mx-auto mt-5 md:mx-0 hover:bg-darkGold text-black hover:text-white py-3 px-4 decoration-0 flex-nowrap">
</form>

@push('scripts')

    <script>
        function createPercentOwnerField() {
            const relationshipSelect = document.querySelector('#relationship');
            if (relationshipSelect.value === 'Owner') {
                // Create a new input element
                const percentOwnerWrapper = document.createElement('div');
                percentOwnerWrapper.setAttribute('id', 'percent_owner_wrapper');
                const percentOwnerLabel = document.createElement('label');
                percentOwnerLabel.setAttribute('class', 'block capitalize');
                percentOwnerLabel.innerHTML = 'Percent Owner';
                percentOwnerWrapper.appendChild(percentOwnerLabel);
                const percentOwnerInput = document.createElement('input');
                percentOwnerInput.setAttribute('type', 'text');
                percentOwnerInput.setAttribute('name', 'percent_owner');
                percentOwnerInput.setAttribute('id', 'percent_owner');
                percentOwnerInput.setAttribute('class', 'shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline');
                percentOwnerWrapper.appendChild(percentOwnerInput);

                // Add the new input element to the form
                relationshipSelect.parentNode.appendChild(percentOwnerWrapper);
            } else {
                // Remove the percent_owner input element if it exists
                const percentOwnerInput = document.querySelector('#percent_owner');
                if (percentOwnerInput) {
                percentOwnerInput.parentNode.removeChild(percentOwnerWrapper);
                }
            }
        }

        // Attach the function to the select element's onchange event
        const relationshipSelect = document.querySelector('#relationship');
        relationshipSelect.addEventListener('change', createPercentOwnerField);

    </script>
    
@endpush