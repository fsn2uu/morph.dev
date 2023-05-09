<form action="{{ route('admin.neighborhoods.update', $neighborhood->slug) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div>
        <label for="name" class="block">Name</label>
        <input type="text" name="name" id="name" value="{{ old('name') ?? $neighborhood->name }}" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
        @error('name')
            <span class="text-red-400">{{ $message }}</span>
        @enderror
    </div>
    <div>
        <label for="description" class="block">Description</label>
        <textarea name="description" id="description" rows="6" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">{{ $neighborhood->description }}</textarea>
        @error('description')
            <span class="text-red-400">{{ $message }}</span>
        @enderror
    </div>
    <div>
        <label for="address" class="block capitalize">Address</label>
        <input type="text" name="address" id="address" value="{{ old('address') ?: (@$neighborhood->address ?: '') }}" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
        @error('address')
            <span class="text-red-400">{{ $message }}</span>
        @enderror
    </div>
    <div>
        <label for="address2" class="block capitalize">Address 2</label>
        <input type="text" name="address2" id="address2" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    <div>
        <label for="city" class="block capitalize">City</label>
        <input type="text" name="city" id="city" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    <div>
        <label for="state" class="block capitalize">State</label>
        <select name="state" id="state" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
            <option value=""></option>
            <option value="AL">Alabama</option>
            <option value="AK">Alaska</option>
            <option value="AZ">Arizona</option>
            <option value="AR">Arkansas</option>
            <option value="CA">California</option>
            <option value="CO">Colorado</option>
            <option value="CT">Connecticut</option>
            <option value="DE">Delaware</option>
            <option value="DC">District Of Columbia</option>
            <option value="FL">Florida</option>
            <option value="GA">Georgia</option>
            <option value="HI">Hawaii</option>
            <option value="ID">Idaho</option>
            <option value="IL">Illinois</option>
            <option value="IN">Indiana</option>
            <option value="IA">Iowa</option>
            <option value="KS">Kansas</option>
            <option value="KY">Kentucky</option>
            <option value="LA">Louisiana</option>
            <option value="ME">Maine</option>
            <option value="MD">Maryland</option>
            <option value="MA">Massachusetts</option>
            <option value="MI">Michigan</option>
            <option value="MN">Minnesota</option>
            <option value="MS">Mississippi</option>
            <option value="MO">Missouri</option>
            <option value="MT">Montana</option>
            <option value="NE">Nebraska</option>
            <option value="NV">Nevada</option>
            <option value="NH">New Hampshire</option>
            <option value="NJ">New Jersey</option>
            <option value="NM">New Mexico</option>
            <option value="NY">New York</option>
            <option value="NC">North Carolina</option>
            <option value="ND">North Dakota</option>
            <option value="OH">Ohio</option>
            <option value="OK">Oklahoma</option>
            <option value="OR">Oregon</option>
            <option value="PA">Pennsylvania</option>
            <option value="RI">Rhode Island</option>
            <option value="SC">South Carolina</option>
            <option value="SD">South Dakota</option>
            <option value="TN">Tennessee</option>
            <option value="TX">Texas</option>
            <option value="UT">Utah</option>
            <option value="VT">Vermont</option>
            <option value="VA">Virginia</option>
            <option value="WA">Washington</option>
            <option value="WV">West Virginia</option>
            <option value="WI">Wisconsin</option>
            <option value="WY">Wyoming</option>
        </select>
    </div>
    <div>
        <label for="zip" class="block capitalize">zip</label>
        <input type="text" name="zip" id="zip" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    <div>
        <label for="status" class="block">Status</label>
        <select name="status" id="status" class="shadow appearance-none border border-[#ccc] mb-4 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
            <option {{ $neighborhood->status == 'Active' ? 'selected' : '' }}>Active</option>
            <option {{ $neighborhood->status == 'Draft' ? 'selected' : '' }}>Draft</option>
        </select>
    </div>
    <input type="submit" value="Update" class="bg-gold mx-auto md:mx-0 mt-5 hover:bg-darkGold text-black hover:text-white py-3 px-4 decoration-0 flex-nowrap">
</form>