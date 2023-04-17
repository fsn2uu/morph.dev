@extends('_template')

@section('content')

    <section id="content-body" class="md:w-[65%] md:mx-auto py-10 px-10 md:px-0 min-h-[60vh]">
        <div class="flex justify-between">
            <h1 class="text-contrastGold text-5xl mb-4">Travelers</h1>
            <div class="items-end">
                <a href="{{ route('admin.travelers.create') }}" class="bg-gold mx-auto md:mx-0 hover:bg-darkGold text-black hover:text-white py-3 px-4 decoration-0 flex-nowrap">Create</a>
            </div>
        </div>

        @if ($travelers->count() > 0)
            @include('admin.travelers._parts.table')
        @else
            <p class="text-center">There are no travelers to display.</p>
        @endif
    </section>

@endsection