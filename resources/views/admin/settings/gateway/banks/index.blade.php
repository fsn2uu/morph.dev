@extends('_template')

@section('content')

    <section id="content-body" class="md:w-[65%] md:mx-auto py-10 px-10 md:px-0 min-h-[60vh]">
        <div class="flex justify-between">
            <h1 class="text-contrastGold text-5xl mb-4">Banks</h1>
            <div class="items-end">
                <a href="{{ route('admin.gateway.banks.create') }}" class="bg-gold mx-auto md:mx-0 hover:bg-darkGold text-black hover:text-white py-3 px-4 decoration-0 flex-nowrap">Create</a>
            </div>
        </div>

        @if (@$_GET['test'])
            {{ dd($banks) }}
        @endif

        <div class="bg-white rounded-lg shadow p-6 mb-10">
            @include('admin.settings.gateway.banks._parts.table')
        </div>
    </section>

@endsection