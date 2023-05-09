<div id="media-library" class="flex flex-wrap -mx-2">
    @foreach($neighborhood->pics as $pic)
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

@push('scripts')
    <script>
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