@extends('_template')

@section('content')

    <section id="content-body" class="md:w-[65%] md:mx-auto py-10 px-10 md:px-0 min-h-[60vh]">
        <div class="flex justify-between">
            <h1 class="text-contrastGold text-5xl mb-4">Payment Gateway Settings</h1>
            <div class="items-end">
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6 mb-10">
            <div class="flex justify-between">
                <div class="py-2 px-4 items-center">
                    <a href="{{ route('admin.settings.gateway.banks.index') }}">
                        <i class="fa-solid fa-building-columns fa-2xl mr-5"></i>
                    </a>
                </div>
                <div class="py-2 px-4">
                    <a href="{{ route('admin.settings.gateway.persons.index') }}">
                        <i class="fa-solid fa-user fa-2xl mr-5"></i>
                    </a>
                </div>
                <div class="py-2 px-4">
                    <a href="{{ route('admin.settings.gateway.transfers.index') }}">
                        <i class="fa-solid fa-money-bill-transfer fa-2xl mr-5"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection