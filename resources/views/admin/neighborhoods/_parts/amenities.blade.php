<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-8 gap-4" id="amenity-grid">
    @if ($amenities->count() > 0)
        @foreach ($amenities as $amenity)
            <div class="flex items-center">
                <input id="amenity-{{ $amenity->id }}" name="amenities[]" {{ old('amenities.'.$amenity->id) ? 'checked' : (@$neighborhood && @$neighborhood->amenities->contains($amenity->id) ? 'checked' : '') }} value="{{ $amenity->id }}" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                <label for="amenity-{{ $amenity->id }}" class="ml-2 block text-sm text-gray-900">
                    {{ $amenity->name }}
                </label>
            </div>
        @endforeach
    @endif
</div>
<a href="#" id="show-form">Add Amenity</a>
<div id="form-container" class="hidden">
    <input type="text" id="amenity-namer" placeholder="Amenity name">
    <a href="#" id="amenity-submitter" class="bg-gold mx-auto mt-5 md:mx-0 hover:bg-darkGold text-black hover:text-white py-3 px-4 decoration-0 flex-nowrap">Create Amenity</a>
</div>

@push('scripts')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const showForm = document.getElementById('show-form');
        const formContainer = document.getElementById('form-container');
        
        showForm.addEventListener('click', function(e) {
            e.preventDefault();
            formContainer.style.display = formContainer.style.display === 'none' ? 'block' : 'none';
        });
    });

    // select the amenity grid and the hidden form
    const amenityGrid = document.getElementById('amenity-grid');
    const amenityName = document.getElementById('amenity-namer');

    // add an event listener to the form to handle submission
    document.getElementById('amenity-submitter').addEventListener('click', function(event) {
        event.preventDefault();
        console.log(amenityName.value)
        
        // make an AJAX request to create the amenity
        axios.post('{{ route('admin.amenities.store') }}', {
            name: amenityName.value,
            type: 'neighborhood',
            company_id: {{ Auth::user()->company->id }}
        })
        .then(function (response) {
            const data = response.data;
            // create a new checkbox for the amenity and add it to the grid
            const checkbox = document.createElement('input');
            checkbox.type = 'checkbox';
            checkbox.name = `amenities[${data.id}]`;
            checkbox.value = data.name;
            checkbox.id = `amenity-${data.id}`;

            const label = document.createElement('label');
            label.htmlFor = `amenity-${data.id}`;
            label.innerText = data.name;

            amenityGrid.appendChild(checkbox);
            amenityGrid.appendChild(label);

            // select the new checkbox
            checkbox.checked = true;
            amenityName.value = ''
        })
        .catch(function (error) {
            console.log(error);
            if(error.response.data.message == 'The name has already been taken.')
            {
                alert('You have already created an amenity with that name.  Please select it from the list.')
            }
        });
    })

</script>
    
@endpush
