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
                    </div>
                    <div>
                        <label for="description" class="block">Description</label>
                        <textarea name="description" id="description" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">{{ $neighborhood->description }}</textarea>
                    </div>
                    <div>
                        <label for="status" class="block">Status</label>
                        <select name="status" id="status" class="shadow appearance-none border border-[#ccc] mb-4 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                            <option {{ $neighborhood->status == 'Active' ? 'selected' : '' }}>Active</option>
                            <option {{ $neighborhood->status == 'Draft' ? 'selected' : '' }}>Draft</option>
                        </select>
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
                <div class="tab-pane fade" id="tabs-photos" role="tabpanel" aria-labelledby="tabs-photos-tab">
                    <p class="text-red-600">Need to get these on a separate tab and setup drag & drop ordering</p>
                    @foreach ($neighborhood->pics as $pic)
                    <img src="{{ asset($pic->filename) }}" alt="" style="max-width: 150px;">
                    @endforeach
                </div>
                {{-- <div class="tab-pane fade" id="tabs-messages" role="tabpanel" aria-labelledby="tabs-messages-tab">
                    Tab 3 content
                </div>
                <div class="tab-pane fade" id="tabs-contact" role="tabpanel" aria-labelledby="tabs-contact-tab">
                    Tab 4 content
                </div> --}}
            </div>
            <input type="submit" value="Update" class="bg-gold mx-auto md:mx-0 mt-5 hover:bg-darkGold text-black hover:text-white py-3 px-4 decoration-0 flex-nowrap">
        </form>
        
    </section>
    
@endsection