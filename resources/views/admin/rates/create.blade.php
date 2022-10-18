@extends('_template')

@section('content')

    <section id="content-body" class="md:w-[65%] md:mx-auto py-10 px-10 md:px-0 min-h-[60vh]">
        <div class="flex justify-between">
            <h1 class="text-contrastGold text-5xl mb-4">Create Rate Tables</h1>
            <div class="items-end">
            </div>
        </div>

        <form action="{{ route('admin.rates.store') }}" method="post">
            @csrf
            <label for="name" class="block">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
            @error('name')
                <span class="text-red-400">{{ $message }}</span>
            @enderror
            <input type="submit" value="Create" class="bg-gold mx-auto mt-5 md:mx-0 hover:bg-darkGold text-black hover:text-white py-3 px-4 decoration-0 flex-nowrap">
        </form>
    </section>
    
@endsection