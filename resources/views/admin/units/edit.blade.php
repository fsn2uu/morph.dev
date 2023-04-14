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
                <div>
                    <label for="pics" class="block capitalize">Photos</label>
                    <input type="file" name="pics[]" id="pics" multiple="multiple" class="block w-full text-sm
                    file:mr-5 file:py-2 file:px-6
                    file:border-0
                    file:text-sm file:font-medium
                    file:bg-gold file:text-black
                    hover:file:cursor-pointer hover:file:bg-darkGold
                    hover:file:text-white
                    ">
                </div>
            </div>
            
            <p class="text-red-600">Need to get these on a separate tab and setup drag & drop ordering</p>
            <label for="" class="block capitalize">Existing Photos</label>
            @foreach ($unit->pics as $pic)
                <div class="flex flex-row mb-3">
                    <img src="{{ asset($pic->filename) }}" alt="" style="max-width: 150px;">
                    <div class="md:ml-5">
                        <label for="existing_pics_{{ $pic->id }}_order">Order</label>
                        <input type="text" id="existing_pics_{{ $pic->id }}_order" name="existing_pics[{{ $pic->id }}][order]" value="{{$pic->order}}" class="shadow appearance-one border border-ccc mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="md:ml-5">
                        <label for="existing_pics_{{ $pic->id }}_alt">Alt Text</label>
                        <input type="text" id="existing_pics_{{ $pic->id }}_alt" name="existing_pics[{{ $pic->id }}][alt]" value="{{$pic->alt}}" class="shadow appearance-one border border-ccc mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="md:ml-5">
                        <label for="existing_pics_{{ $pic->id }}_description">Description</label>
                        <input type="text" id="existing_pics_{{ $pic->id }}_description" name="existing_pics[{{ $pic->id }}][description]" value="{{$pic->description}}" class="shadow appearance-one border border-ccc mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="md:ml-5">
                        [X]
                    </div>
                </div>
            @endforeach
            <div>
                <label for="description" class="block capitalize">Description</label>
                <textarea name="description" id="description" rows="10" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">{{ $unit->description }}</textarea>
            </div>
            <input type="submit" value="Update" class="bg-gold mx-auto md:mx-0 hover:bg-darkGold text-black hover:text-white py-3 px-4 decoration-0 flex-nowrap">
        </form>
    </section>
    
@endsection