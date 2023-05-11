<!-- Spaces -->
<div id="space-rows">
    <div class="mt-4">
        <label class="block font-medium text-gray-700">Spaces</label>

        <div class="mt-2 space-y-4 mb-5" id="parentTarget">
            <div class="flex items-center space-x-4 gap-4">
                <select name="spaces[0][type]" class="space-type-switch w-1/4 block rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Choose a Space Type</option>
                    <option>Living Room</option>
                    <option>Dining Room</option>
                    <option>Bedroom</option>
                    <option>Bathroom</option>
                </select>
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
        Add Space
    </button>
    <button type="button" class="bg-red-500 text-white px-4 py-2 rounded-md ml-4" onclick="removeLastRow()">
        Remove Last Space
    </button>
</div>

@push('scripts')
    <script>
        function createInputFields(inputs, parentContainer, targetClass) {
            const inputElements = document.createElement('div');
            inputElements.classList.add('flex', 'justify-between', targetClass)
            for (const input of inputs) {
                const { name, type, label, value, options } = input;

                const labelElement = document.createElement('label');
                labelElement.classList.add('block', 'mb-2');
                labelElement.textContent = label;

                let inputElement = document.createElement('div');

                if (type === 'select') {
                inputElement = document.createElement('select');
                inputElement.name = name;
                inputElement.classList.add('border', 'rounded', 'px-2', 'py-1', 'mb-2');
                for (let i = 0; i < options.length; i++) {
                    const optionElement = document.createElement('option');
                    optionElement.value = options[i].value;
                    optionElement.textContent = options[i].label;
                    if (value === options[i].value) {
                    optionElement.selected = true;
                    }
                    inputElement.appendChild(optionElement);
                }
                } else if (type === 'checkbox') {
                    inputElement = document.createElement('input');
                    inputElement.name = name;
                    inputElement.type = 'checkbox';
                    inputElement.checked = value;
                    inputElement.classList.add('border', 'rounded', 'px-2', 'py-1', 'mb-2');
                } else {
                    inputElement = document.createElement('input');
                    inputElement.name = name;
                    inputElement.type = type;
                    inputElement.value = value;
                    inputElement.classList.add('border', 'rounded', 'px-2', 'py-1', 'mb-2');
                }

                const divElement = document.createElement('div');
                divElement.appendChild(labelElement);
                divElement.appendChild(inputElement);

                inputElements.appendChild(divElement)
            }

            parentContainer.appendChild(inputElements)
        }

        document.addEventListener('change', function(event)
        {
            if (event.target.classList.contains('space-type-switch'))
            {
                doTheThing(event)
            }
        });

        function doTheThing(event)
        {
            const selectedOption = event.target.value;
            const parentContainer = event.target.parentElement.parentElement;
            const parentLength = parentContainer.children.length
            const rowSelector = '.mt-2'; // replace with your actual selector
            const currentRow = event.target.parentElement.parentElement;
            const rows = currentRow.parentElement.querySelectorAll(rowSelector);
            const index = Array.prototype.indexOf.call(rows, currentRow);

            if(parentLength > 1)
            {
                parentContainer.removeChild(parentContainer.lastElementChild)
            }
            
            if (selectedOption === 'Living Room') {
                createInputFields(
                    [
                        { name: 'spaces['+index+'][floor_type]', type: 'select', label: 'Floor Type', options: [
                            { value: 'carpet', label: 'Carpet' },
                            { value: 'tile', label: 'Tile' },
                            { value: 'hardwood', label: 'Hardwood' },
                            { value: 'other', label: 'Other' },
                        ] },
                        { name: 'spaces['+index+'][square_footage]', type: 'text', label: 'Square Footage', value: '200 sq ft' },
                        { name: 'spaces['+index+'][tv_type]', type: 'select', label: 'TV Type', value: 'Smart', options: [
                            { value: 'CRT', label: 'CRT' },
                            { value: 'Smart', label: 'Smart' },
                            { value: 'Plasma', label: 'Plasma' },
                            { value: 'LED', label: 'LED' },
                            { value: 'oLED', label: 'oLED' },
                            { value: 'Projection', label: 'Projection' },
                            { value: 'Other', label: 'Other' },
                            { value: 'None', label: 'None' },
                        ] },
                        { name: 'spaces['+index+'][trundle]', type: 'checkbox', label: 'Trundle', value: 1 },
                        { name: 'spaces['+index+'][sleeper_sofa]', type: 'checkbox', label: 'Sleeper Sofa', value: 1 },
                    ]
                , parentContainer, 'living-room-fields')
            } else if(selectedOption === 'Bedroom') {
                createInputFields([
                    { name: 'spaces['+index+'][floor_type]', type: 'select', label: 'Floor Type', options: [
                            { value: 'carpet', label: 'Carpet' },
                            { value: 'tile', label: 'Tile' },
                            { value: 'hardwood', label: 'Hardwood' },
                            { value: 'other', label: 'Other' },
                        ] },
                        { name: 'spaces['+index+'][square_footage]', type: 'text', label: 'Square Footage', value: '200 sq ft' },
                        { name: 'spaces['+index+'][tv_type]', type: 'select', label: 'TV Type', value: 'Smart', options: [
                            { value: 'CRT', label: 'CRT' },
                            { value: 'Smart', label: 'Smart' },
                            { value: 'Plasma', label: 'Plasma' },
                            { value: 'LED', label: 'LED' },
                            { value: 'oLED', label: 'oLED' },
                            { value: 'Projection', label: 'Projection' },
                            { value: 'Other', label: 'Other' },
                            { value: 'None', label: 'None' },
                        ] },
                        { name: 'spaces['+index+'][trundle]', type: 'checkbox', label: 'Trundle', value: 1 },
                        { name: 'spaces['+index+'][usb_near_bed]', type: 'checkbox', label: 'USB Near Bed', value: 1 },
                        { name: 'spaces['+index+'][connected_bath]', type: 'checkbox', label: 'Connected Bath', value: 1 },
                        { name: 'spaces['+index+'][balcony_access]', type: 'checkbox', label: 'Balcony Access', value: 1 },
                ], parentContainer, 'bedroom-fields')
            }
        }

        function addRow()
        {
            const spaceContainer = document.getElementById('space-rows')
            const parentContainer = document.querySelector('#parentTarget')
            const parentLength = parentContainer.children.length
            const rowSelector = '.mt-2'; // replace with your actual selector
            const currentRow = event.target.parentElement.parentElement;
            const rows = currentRow.parentElement.querySelectorAll(rowSelector);
            const index = Array.prototype.indexOf.call(rows, currentRow)+1;

            const rowContainer = document.createElement('div')
            rowContainer.classList.add('mt-2', 'space-y-4', 'mb-5')
            rowContainer.innerHTML = `<div class="flex items-center space-x-4 gap-4">
                <select name="spaces[`+index+`][type]" class="space-type-switch w-1/4 block rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Choose a Space Type</option>
                    <option>Living Room</option>
                    <option>Dining Room</option>
                    <option>Bedroom</option>
                    <option>Bathroom</option>
                </select>
                <button type="button" class="ml-2 text-red-500 focus:outline-none" onclick="removeRow(this)">
                    Remove
                </button>
            </div>`
            spaceContainer.appendChild(rowContainer)
        }

        function removeRow(button)
        {
            const row = button.parentNode;
            row.parentNode.removeChild(row);
        }

        function removeLastRow() {
            const container = document.getElementById('space-rows');
            const rows = container.getElementsByClassName('mt-2 space-y-4 mb-5');
            if (rows.length > 1) {
                container.removeChild(rows[rows.length - 1]);
            }
        }
    </script>
@endpush