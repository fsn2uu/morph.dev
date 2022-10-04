@extends('_template')

@section('content')

    <section id="content-body" class="md:w-[65%] md:mx-auto py-10 px-10 md:px-0 min-h-[60vh]">
        <div class="flex justify-between">
            <h1 class="text-contrastGold text-5xl mb-4">Edit a Neighborhood</h1>
            <div class="items-end">
            </div>
        </div>
        <form action="{{ route('admin.neighborhoods.update', $neighborhood->slug) }}" method="post">
            @csrf
            @method('PATCH')
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
            <input type="submit" value="Update" class="bg-gold mx-auto md:mx-0 hover:bg-darkGold text-black hover:text-white py-3 px-4 decoration-0 flex-nowrap">
        </form>
    </section>
    
@endsection