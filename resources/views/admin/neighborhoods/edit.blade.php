@extends('_template')

@section('content')

    <section id="content-body" class="md:w-[65%] md:mx-auto py-10 px-10 md:px-0 min-h-[60vh]">
        <div class="flex justify-between">
            <h1 class="text-contrastGold text-5xl mb-4">Edit a Neighborhood</h1>
            <div class="items-end">
            </div>
        </div>
        <ul class="nav nav-tabs flex flex-col md:flex-row flex-wrap list-none border-b-0 pl-0 mb-4" id="tabs-tab"
            role="tablist">
            <li class="nav-item" role="presentation">
                <a href="#tabs-general" class="
                nav-link
                block
                font-medium
                text-xs
                leading-tight
                uppercase
                border-x-0 border-t-0 border-b-2 border-transparent
                px-6
                py-3
                my-2
                hover:border-transparent hover:bg-gray-100
                focus:border-transparent
                active
                " id="tabs-general-tab" data-bs-toggle="pill" data-bs-target="#tabs-general" role="tab" aria-controls="tabs-general"
                aria-selected="true">General</a>
            </li>
            <li class="nav-item" role="presentation">
                <a href="#tabs-amenities" class="
                nav-link
                block
                font-medium
                text-xs
                leading-tight
                uppercase
                border-x-0 border-t-0 border-b-2 border-transparent
                px-6
                py-3
                my-2
                hover:border-transparent hover:bg-gray-100
                focus:border-transparent
                active
                " id="tabs-amenities-tab" data-bs-toggle="pill" data-bs-target="#tabs-amenities" role="tab" aria-controls="tabs-amenities"
                aria-selected="true">Amenities</a>
            </li>
            <li class="nav-item" role="presentation">
                <a href="#tabs-photos" class="
                nav-link
                block
                font-medium
                text-xs
                leading-tight
                uppercase
                border-x-0 border-t-0 border-b-2 border-transparent
                px-6
                py-3
                my-2
                hover:border-transparent hover:bg-gray-100
                focus:border-transparent
                " id="tabs-photos-tab" data-bs-toggle="pill" data-bs-target="#tabs-photos" role="tab"
                aria-controls="tabs-photos" aria-selected="false">Photos</a>
            </li>
            <li class="nav-item" role="presentation">
                <a href="#units-photos" class="
                nav-link
                block
                font-medium
                text-xs
                leading-tight
                uppercase
                border-x-0 border-t-0 border-b-2 border-transparent
                px-6
                py-3
                my-2
                hover:border-transparent hover:bg-gray-100
                focus:border-transparent
                " id="tabs-units-tab" data-bs-toggle="pill" data-bs-target="#tabs-units" role="tab"
                aria-controls="tabs-units" aria-selected="false">Units</a>
            </li>
            {{-- <li class="nav-item" role="presentation">
                <a href="#tabs-messages" class="
                nav-link
                block
                font-medium
                text-xs
                leading-tight
                uppercase
                border-x-0 border-t-0 border-b-2 border-transparent
                px-6
                py-3
                my-2
                hover:border-transparent hover:bg-gray-100
                focus:border-transparent
                " id="tabs-messages-tab" data-bs-toggle="pill" data-bs-target="#tabs-messages" role="tab"
                aria-controls="tabs-messages" aria-selected="false">Messages</a>
            </li>
            <li class="nav-item" role="presentation">
                <a href="#tabs-contact" class="
                nav-link
                disabled
                pointer-events-none
                block
                font-medium
                text-xs
                leading-tight
                uppercase
                border-x-0 border-t-0 border-b-2 border-transparent
                px-6
                py-3
                my-2
                hover:border-transparent hover:bg-gray-100
                focus:border-transparent
                " id="tabs-contact-tab" data-bs-toggle="pill" data-bs-target="#tabs-contact" role="tab"
                aria-controls="tabs-contact" aria-selected="false">Contact</a>
            </li> --}}
        </ul>
        <form action="{{ route('admin.neighborhoods.update', $neighborhood->slug) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
        <div class="tab-content" id="tabs-tabContent">
            <div class="tab-pane fade show active" id="tabs-general" role="tabpanel" aria-labelledby="tabs-general-tab">
                <div>
                    <label for="name" class="block">Name</label>
                    <input type="text" name="name" id="name" value="{{ $neighborhood->name }}" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                    @error('name')
                        <span class="text-red-400">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="description" class="block">Description</label>
                    <textarea name="description" id="description" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">{{ $neighborhood->description }}</textarea>
                    @error('description')
                        <span class="text-red-400">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="status" class="block">Status</label>
                    <select name="status" id="status" class="shadow appearance-none border border-[#ccc] mb-4 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                        <option {{ $neighborhood->status == 'Active' ? 'selected' : '' }}>Active</option>
                        <option {{ $neighborhood->status == 'Draft' ? 'selected' : '' }}>Draft</option>
                    </select>
                </div>
            </div>
            <div class="tab-pane fade" id="tabs-amenities" role="tabpanel" aria-labelledby="tabs-amenities-tab">
                @include('admin.neighborhoods._parts.amenities')
            </div>
                <div class="tab-pane fade" id="tabs-photos" role="tabpanel" aria-labelledby="tabs-photos-tab">
                    <div class="mb-5">
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
                    <p class="text-red-600">Need to get these on a separate tab and setup drag & drop ordering</p>
                    <label for="" class="block capitalize">Existing Photos</label>
                    @foreach ($neighborhood->pics as $pic)
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
                </div>
                <div class="tab-pane fade" id="tabs-units" role="tabpanel" aria-labelledby="tabs-units-tab">
        @if ($neighborhood->units->count() < 1)
            <p class="text-center">There are no units to show.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th class="py-2 px-4">Name</th>
                        <th class="py-2 px-4">Neighborhood</th>
                        <th class="py-2 px-4">Status</th>
                        <th class="py-2 px-4">Last Updated</th>
                        <th class="py-2 px-4"></th>
                        <tbody>
                            @foreach ($neighborhood->units as $unit)
                                <tr>
                                    <td class="py-2 px-4">
                                        <a href="{{ route('admin.units.show', $unit->slug) }}" class="underline text-blue-400">{{ $unit->name }}</a>
                                    </td>
                                    <td class="py-2 px-4 text-center">{{ $unit->neighborhood->name }}</td>
                                    <td class="py-2 px-4">{{ ucwords($unit->status) }}</td>
                                    <td class="py-2 px-4">{{ \Carbon\Carbon::parse($unit->updated_at)->format('Y-m-d') }}</td>
                                    <td class="py-2 px-4">
                                        <a href="{{ route('admin.units.edit', $unit->slug) }}" class="text-white bg-blue-600 hover:bg-blue-800 p-2 pr-1 mr-2 rounded-sm">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </tr>
                </thead>
            </table>
        @endif
                </div>
                {{-- <div class="tab-pane fade" id="tabs-contact" role="tabpanel" aria-labelledby="tabs-contact-tab">
                    Tab 4 content
                </div> --}}
            </div>
            <input type="submit" value="Update" class="bg-gold mx-auto md:mx-0 mt-5 hover:bg-darkGold text-black hover:text-white py-3 px-4 decoration-0 flex-nowrap">
        </form>
        
    </section>
    
@endsection