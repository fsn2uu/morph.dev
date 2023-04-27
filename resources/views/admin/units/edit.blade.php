@extends('_template')

@section('content')

    <section id="content-body" class="md:w-[65%] md:mx-auto py-10 px-10 md:px-0 min-h-[60vh]">
        <div class="flex justify-between">
            <h1 class="text-contrastGold text-5xl mb-4">Edit a Unit</h1>
            <div class="items-end">
            </div>
        </div>
        <form action="{{ route('admin.units.update', $unit->slug) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="border-b border-gray-200">
                <nav class="flex -mb-px space-x-8" aria-label="Tabs">
                    <a href="#" class="tab-link text-gray-500 hover:text-gray-700 font-medium border-transparent border-b-2 hover:border-gray-300 py-4 px-1">
                        Information
                    </a>
                    <a href="#" class="tab-link text-gray-500 hover:text-gray-700 font-medium border-transparent border-b-2 hover:border-gray-300 py-4 px-1">
                        Photos
                    </a>
                    <a href="#" class="tab-link text-gray-500 hover:text-gray-700 font-medium border-transparent border-b-2 hover:border-gray-300 py-4 px-1">
                        Reservations
                    </a>
                    <a href="#" class="tab-link text-gray-500 hover:text-gray-700 font-medium border-transparent border-b-2 hover:border-gray-300 py-4 px-1">
                        Specials
                    </a>
                    <a href="#" class="tab-link text-gray-500 hover:text-gray-700 font-medium border-transparent border-b-2 hover:border-gray-300 py-4 px-1">
                        Tasks
                    </a>
                </nav>
            </div>

            <div class="tabs">
                <div class="tab-content pt-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="name" class="block capitalize">Name</label>
                            <input type="text" name="name" id="name" value="{{ $unit->name }}" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <div>
                            <label for="status" class="block capitalize">Status</label>
                            <select name="status" id="status" class="shadow appearance-none border border-[#ccc] mb-4 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                                <option {{ $unit->status == 'Active' ? 'selected' : '' }}>Active</option>
                                <option {{ $unit->status == 'Draft' ? 'selected' : '' }}>Draft</option>
                            </select>
                        </div>
                        <div>
                            <label for="neighborhood_id">Neighborhood</label capitalize>
                            <select name="neighborhood_id" id="neighborhood_id" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                                <option value=""></option>
                                @foreach (App\Models\Neighborhood::where('company_id', Auth::user()->company_id)->get() as $neighborhood)
                                <option value="{{ $neighborhood->id }}" {{ @$unit->neighborhood->id == $neighborhood->id ? 'selected' : '' }}>{{ $neighborhood->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="address" class="block capitalize">Address</label>
                            <input type="text" name="address" id="address" value="{{ $unit->address }}" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <div>
                            <label for="address2" class="block capitalize">Address 2</label>
                            <input type="text" name="address2" id="address2" value="{{ $unit->address2 }}" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <div>
                            <label for="city" class="block capitalize">City</label>
                            <input type="text" name="city" id="city" value="{{ $unit->city }}" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <div>
                            <label for="state" class="block capitalize">State</label>
                            <select name="state" id="state" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                                <option value=""></option>
                                <option value="AL" {{ $unit->state == 'AL' ? 'selected' : '' }}>Alabama</option>
                                <option value="AK" {{ $unit->state == 'AK' ? 'selected' : '' }}>Alaska</option>
                                <option value="AZ" {{ $unit->state == 'AZ' ? 'selected' : '' }}>Arizona</option>
                                <option value="AR" {{ $unit->state == 'AR' ? 'selected' : '' }}>Arkansas</option>
                                <option value="CA" {{ $unit->state == 'CA' ? 'selected' : '' }}>California</option>
                                <option value="CO" {{ $unit->state == 'CO' ? 'selected' : '' }}>Colorado</option>
                                <option value="CT" {{ $unit->state == 'CT' ? 'selected' : '' }}>Connecticut</option>
                                <option value="DE" {{ $unit->state == 'DE' ? 'selected' : '' }}>Delaware</option>
                                <option value="DC" {{ $unit->state == 'DC' ? 'selected' : '' }}>District Of Columbia</option>
                                <option value="FL" {{ $unit->state == 'FL' ? 'selected' : '' }}>Florida</option>
                                <option value="GA" {{ $unit->state == 'GA' ? 'selected' : '' }}>Georgia</option>
                                <option value="HI" {{ $unit->state == 'HI' ? 'selected' : '' }}>Hawaii</option>
                                <option value="ID" {{ $unit->state == 'ID' ? 'selected' : '' }}>Idaho</option>
                                <option value="IL" {{ $unit->state == 'IL' ? 'selected' : '' }}>Illinois</option>
                                <option value="IN" {{ $unit->state == 'IN' ? 'selected' : '' }}>Indiana</option>
                                <option value="IA" {{ $unit->state == 'IA' ? 'selected' : '' }}>Iowa</option>
                                <option value="KS" {{ $unit->state == 'KS' ? 'selected' : '' }}>Kansas</option>
                                <option value="KY" {{ $unit->state == 'KY' ? 'selected' : '' }}>Kentucky</option>
                                <option value="LA" {{ $unit->state == 'LA' ? 'selected' : '' }}>Louisiana</option>
                                <option value="ME" {{ $unit->state == 'ME' ? 'selected' : '' }}>Maine</option>
                                <option value="MD" {{ $unit->state == 'MD' ? 'selected' : '' }}>Maryland</option>
                                <option value="MA" {{ $unit->state == 'MA' ? 'selected' : '' }}>Massachusetts</option>
                                <option value="MI" {{ $unit->state == 'MI' ? 'selected' : '' }}>Michigan</option>
                                <option value="MN" {{ $unit->state == 'MN' ? 'selected' : '' }}>Minnesota</option>
                                <option value="MS" {{ $unit->state == 'MS' ? 'selected' : '' }}>Mississippi</option>
                                <option value="MO" {{ $unit->state == 'MO' ? 'selected' : '' }}>Missouri</option>
                                <option value="MT" {{ $unit->state == 'MT' ? 'selected' : '' }}>Montana</option>
                                <option value="NE" {{ $unit->state == 'NE' ? 'selected' : '' }}>Nebraska</option>
                                <option value="NV" {{ $unit->state == 'NV' ? 'selected' : '' }}>Nevada</option>
                                <option value="NH" {{ $unit->state == 'NH' ? 'selected' : '' }}>New Hampshire</option>
                                <option value="NJ" {{ $unit->state == 'NJ' ? 'selected' : '' }}>New Jersey</option>
                                <option value="NM" {{ $unit->state == 'NM' ? 'selected' : '' }}>New Mexico</option>
                                <option value="NY" {{ $unit->state == 'NY' ? 'selected' : '' }}>New York</option>
                                <option value="NC" {{ $unit->state == 'NC' ? 'selected' : '' }}>North Carolina</option>
                                <option value="ND" {{ $unit->state == 'ND' ? 'selected' : '' }}>North Dakota</option>
                                <option value="OH" {{ $unit->state == 'OH' ? 'selected' : '' }}>Ohio</option>
                                <option value="OK" {{ $unit->state == 'OK' ? 'selected' : '' }}>Oklahoma</option>
                                <option value="OR" {{ $unit->state == 'OR' ? 'selected' : '' }}>Oregon</option>
                                <option value="PA" {{ $unit->state == 'PA' ? 'selected' : '' }}>Pennsylvania</option>
                                <option value="RI" {{ $unit->state == 'RI' ? 'selected' : '' }}>Rhode Island</option>
                                <option value="SC" {{ $unit->state == 'SC' ? 'selected' : '' }}>South Carolina</option>
                                <option value="SD" {{ $unit->state == 'SD' ? 'selected' : '' }}>South Dakota</option>
                                <option value="TN" {{ $unit->state == 'TN' ? 'selected' : '' }}>Tennessee</option>
                                <option value="TX" {{ $unit->state == 'TX' ? 'selected' : '' }}>Texas</option>
                                <option value="UT" {{ $unit->state == 'UT' ? 'selected' : '' }}>Utah</option>
                                <option value="VT" {{ $unit->state == 'VT' ? 'selected' : '' }}>Vermont</option>
                                <option value="VA" {{ $unit->state == 'VA' ? 'selected' : '' }}>Virginia</option>
                                <option value="WA" {{ $unit->state == 'WA' ? 'selected' : '' }}>Washington</option>
                                <option value="WV" {{ $unit->state == 'WV' ? 'selected' : '' }}>West Virginia</option>
                                <option value="WI" {{ $unit->state == 'WI' ? 'selected' : '' }}>Wisconsin</option>
                                <option value="WY" {{ $unit->state == 'WY' ? 'selected' : '' }}>Wyoming</option>
                            </select>
                        </div>
                        <div>
                            <label for="zip" class="block capitalize">zip</label>
                            <input type="text" name="zip" id="zip" value="{{ $unit->zip }}" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <div>
                            <label for="beds" class="block capitalize">beds</label>
                            <input type="text" name="beds" id="beds" value="{{ $unit->beds }}" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <div>
                            <label for="baths" class="block capitalize">baths</label>
                            <input type="text" name="baths" id="baths" value="{{ $unit->baths }}" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <div>
                            <label for="sleeps" class="block capitalize">sleeps</label>
                            <input type="text" name="sleeps" id="sleeps" value="{{ $unit->sleeps }}" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                    </div>
                    <div>
                        <label for="description" class="block capitalize">Description</label>
                        <textarea name="description" id="description" rows="10" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">{{ $unit->description }}</textarea>
                    </div>
                </div>
                <div class="tab-content pt-5 hidden">

                    <div id="media-library" class="flex flex-wrap -mx-2">
                        @foreach($unit->pics as $pic)
                            <div class="w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/6 px-2 mb-4">
                                <div class="relative">
                                <img src="{{ asset($pic->filename) }}" alt="{{ $pic->alt }}" class="w-full h-auto rounded-md">
                                <div class="absolute top-0 right-0 mr-2 mt-2">
                                    <button class="delete-pic-button p-1 rounded-full bg-red-500 hover:bg-red-600 text-white focus:outline-none">
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                        <path d="M10 1c-4.4 0-8 3.6-8 8s3.6 8 8 8 8-3.6 8-8-3.6-8-8-8zM14.5 12.5l-2.1 2.1-2.4-2.4-2.4 2.4-2.1-2.1 2.4-2.4-2.4-2.4 2.1-2.1 2.4 2.4 2.4-2.4 2.1 2.1-2.4 2.4z"></path>
                                    </svg>
                                    </button>
                                </div>
                                <button class="open-modal-button absolute bottom-0 left-0 w-full h-full opacity-0 hover:opacity-100 focus:outline-none"></button>
                                </div>
                            </div>
                        @endforeach
                      </div>
                      
                      <div class="mt-4">
                        <label for="file-input" class="cursor-pointer bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">
                          Upload Image
                        </label>
                        <input id="file-input" type="file" class="hidden">
                      </div>
                      
                      <!-- Modal for viewing image details -->
                      <div id="modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
                        <div class="bg-white rounded-lg p-4 max-w-[60%] lg:flex">
                          <img id="modal-image" src="" alt="" class="w-full lg:w-1/2">
                          <div class="lg:w-1/2 lg:pl-4 mt-4">
                            <label for="title-input" class="block font-medium">Title</label>
                            <input id="title-input" type="text" class="w-full rounded border-gray-300 mt-1 mb-4">
                            <label for="alt-input" class="block font-medium">Alt Text</label>
                            <input id="alt-input" type="text" class="w-full rounded border-gray-300 mt-1 mb-4">
                            <label for="description-input" class="block font-medium">Description</label>
                            <textarea id="description-input" class="w-full rounded border-gray-300 mt-1 mb-4"></textarea>
                            <div class="flex justify-end">
                              <button id="delete-pic-button" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded mr-4">Delete</button>
                              <button id="save-button" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">Save</button>
                              <button id="cancel-button" class="ml-4 border border-gray-300 py-2 px-4 rounded">Cancel</button>
                            </div>
                          </div>
                        </div>
                      </div>

                      <!-- Delete Confirmation Modal -->
                        <div class="hidden fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" id="delete-confirmation-modal">
                            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <div class="sm:flex sm:items-start">
                                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                    <!-- Heroicon name: exclamation -->
                                    <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16M12 9v2m0 4h.01"></path>
                                    </svg>
                                    </div>
                                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
                                        Delete Confirmation
                                    </h3>
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-500">
                                        Are you sure you want to delete this item? This action cannot be undone.
                                        </p>
                                    </div>
                                    </div>
                                </div>
                                </div>
                                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                <button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm" onclick="deleteItem()">
                                    Delete
                                </button>
                                <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" onclick="hideDeleteConfirmationModal()">
                                    Cancel
                                </button>
                                </div>
                            </div>
                            </div>
                        </div>
                </div>
  

                  



                <div class="tab-content pt-5 hidden">
                    <p>Here is the content for the Reservations tab.</p>
                </div>
                <div class="tab-content pt-5 hidden">
                    <p>Here is the content for the Specials tab.</p>
                </div>
                <div class="tab-content pt-5  hidden">
                    <p>Here is the content for the Tasks tab.</p>
                </div>
            </div>
              
            <input type="submit" value="Update" class="bg-gold mx-auto md:mx-0 hover:bg-darkGold text-black hover:text-white py-3 px-4 decoration-0 flex-nowrap">
        </form>
    </section>
    
@endsection

@push('scripts')

<script>
const tabLinks = document.querySelectorAll('.tab-link');
const tabContents = document.querySelectorAll('.tab-content');

tabLinks.forEach((tabLink, index) => {
  tabLink.addEventListener('click', (event) => {
    event.preventDefault();
    tabLinks.forEach((link) => link.classList.remove('border-indigo-500', 'text-indigo-600'));
    tabContents.forEach((content) => content.classList.add('hidden'));
    tabLink.classList.add('border-indigo-500', 'text-indigo-600');
    tabContents[index].classList.remove('hidden');
  });
});



// Get references to elements
const modal = document.querySelector('#modal');
const modalImage = document.querySelector('#modal-image');
const titleInput = document.querySelector('#title-input');
const altInput = document.querySelector('#alt-input');
const descriptionInput = document.querySelector('#description-input');
const saveButton = document.querySelector('#save-button');
const cancelButton = document.querySelector('#cancel-button');
const deletePicButton = document.querySelector('#delete-pic-button');
const deleteConfirmationModal = document.querySelector('#delete-confirmation-modal');
const confirmDeleteButton = document.querySelector('#confirm-delete-button');
const cancelDeleteButton = document.querySelector('#cancel-delete-button');
const openModalButtons = document.querySelectorAll('.open-modal-button');

// Function to show modal and populate with image details
function showModal(event) {
  // Prevent default behavior of button click
  event.preventDefault();

  // Get details of clicked image
  const clickedImage = event.currentTarget.previousElementSibling.previousElementSibling;
  const src = clickedImage.getAttribute('src');
  const alt = clickedImage.getAttribute('alt');

  // Populate modal with image details
  modalImage.setAttribute('src', src);
  titleInput.value = '';
  altInput.value = alt;
  descriptionInput.value = '';

  // Show modal
  modal.classList.remove('hidden');
}

// Add event listener to each open-modal-button
openModalButtons.forEach(button => {
  button.addEventListener('click', showModal);
});

// Function to hide modal
function hideModal(event) {
    event.preventDefault()
  modal.classList.add('hidden');
}

// Function to show delete confirmation modal
function showDeleteConfirmationModal(event) {
    event.preventDefault()
  deleteConfirmationModal.classList.remove('hidden');
}

// Function to hide delete confirmation modal
function hideDeleteConfirmationModal(event) {
    event.preventDefault()
  deleteConfirmationModal.classList.add('hidden');
}

// Function to delete image
function deleteImage(event) {
    event.preventDefault()
  // TODO: Delete image
  hideModal();
}

// Add event listener to cancel button to hide modal
cancelButton.addEventListener('click', hideModal);

// Add event listener to save button to save image details and hide modal
saveButton.addEventListener('click', (event) => {
    event.preventDefault()
  // TODO: Save image details
  hideModal();
});

// Add event listener to delete button to show delete confirmation modal
deletePicButton.addEventListener('click', showDeleteConfirmationModal);

// Add event listener to confirm delete button to delete image and hide delete confirmation modal
confirmDeleteButton.addEventListener('click', () => {
  deleteImage();
  hideDeleteConfirmationModal();
});

// Add event listener to cancel delete button to hide delete confirmation modal
cancelDeleteButton.addEventListener('click', hideDeleteConfirmationModal);








</script>
    
@endpush