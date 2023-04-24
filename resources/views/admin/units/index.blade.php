@extends('_template')

@section('content')

    <section id="content-body" class="md:w-[65%] md:mx-auto py-10 px-10 md:px-0 min-h-[60vh]">
        <div class="flex justify-between">
            <h1 class="text-contrastGold text-5xl mb-4">Units</h1>
            <div class="items-end">
                <a href="{{ route('admin.units.create') }}" class="bg-gold mx-auto md:mx-0 hover:bg-darkGold text-black hover:text-white py-3 px-4 decoration-0 flex-nowrap">Create</a>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6 mb-10">
            <form action="{{ route('admin.units.index') }}" method="GET" class="grid grid-cols-1 gap-4">
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                  <label for="start_date" class="block font-medium text-gray-700">Start Date</label>
                  <input type="date" name="start_date" id="start_date" class="form-input mt-1 block w-full" value="{{ old('start_date') }}">
                </div>
                <div>
                  <label for="end_date" class="block font-medium text-gray-700">End Date</label>
                  <input type="date" name="end_date" id="end_date" class="form-input mt-1 block w-full" value="{{ old('end_date') }}">
                </div>
              </div>
          
              <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                  <label for="beds" class="block font-medium text-gray-700">Beds</label>
                  <input type="number" name="beds" id="beds" class="form-input mt-1 block w-full" value="{{ old('beds') ?? $_GET['beds'] ?? '' }}" min="0" max="10">
                </div>
                <div>
                  <label for="baths" class="block font-medium text-gray-700">Baths</label>
                  <input type="number" name="baths" id="baths" class="form-input mt-1 block w-full" value="{{ old('baths') ?? $_GET['baths'] ?? '' }}" min="0" max="10">
                </div>
                <div>
                  <label for="sleeps" class="block font-medium text-gray-700">Sleeps</label>
                  <input type="number" name="sleeps" id="sleeps" class="form-input mt-1 block w-full" value="{{ old('sleeps') ?? $_GET['sleeps'] ?? '' }}" min="0" max="20">
                </div>
              </div>
          
              <div class="mt-4 flex items-center justify-between">
                <div>
                  <a href="#" class="text-sm font-medium text-gray-700 hover:text-blue-500" id="toggleAdvancedSearch">Advanced Search Options</a>
                </div>
                <button type="submit" class="bg-gold mx-auto md:mx-0 hover:bg-darkGold text-black hover:text-white py-3 px-4 decoration-0 flex-nowrap">Search</button>
              </div>
          
              <div id="advancedSearchOptions" class="hidden mt-4 grid grid-cols-1 gap-4">
                <div>
                  <label for="amenities" class="block font-medium text-gray-700">Amenities</label>
                  <input type="text" name="amenities" id="amenities" class="form-input mt-1 block w-full" value="{{ old('amenities') }}">
                </div>
                <div>
                  <label for="neighborhood" class="block font-medium text-gray-700">Neighborhood</label>
                  <input type="text" name="neighborhood" id="neighborhood" class="form-input mt-1 block w-full" value="{{ old('neighborhood') }}">
                </div>
              </div>
            </form>
          </div>

        @include('admin.units._parts.table')
    </section>
    
@endsection

@push('scripts')
<script>
// Get the advanced search link and form sections
const advancedSearchLink = document.getElementById('toggleAdvancedSearch');
const amenitiesSection = document.getElementById('advancedSearchOptions');

// Hide the advanced search sections by default
amenitiesSection.style.display = 'none';

// Add a click event listener to the advanced search link
advancedSearchLink.addEventListener('click', (event) => {
  event.preventDefault();

  // Toggle the display of the advanced search sections
  if (amenitiesSection.style.display === 'none') {
    amenitiesSection.style.display = 'block';
  } else {
    amenitiesSection.style.display = 'none';
  }

  // Animate the sliding of the form sections
  const sections = [amenitiesSection];
  const animationDuration = 300; // milliseconds
  let totalHeight = 0;

  sections.forEach((section) => {
    totalHeight += section.scrollHeight;
  });

  const easing = (t) => t * t;
  let start = null;

  const animate = (timestamp) => {
    if (!start) {
      start = timestamp;
    }

    const elapsed = timestamp - start;
    const progress = easing(Math.min(1, elapsed / animationDuration));
    const height = totalHeight * progress;

    sections.forEach((section) => {
      section.style.height = `${height}px`;
    });

    if (elapsed >= animationDuration) {
      // Show the inputs after the animation is complete
      const inputs = document.querySelectorAll('#advancedSearchOptions input');
      inputs.forEach((input) => {
        input.style.display = 'block';
      });
    } else {
      window.requestAnimationFrame(animate);
    }
  };

  window.requestAnimationFrame(animate);
});

</script>
@endpush