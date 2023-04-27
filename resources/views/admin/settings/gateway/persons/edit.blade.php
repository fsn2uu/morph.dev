@extends('_template')

@section('content')

    <section id="content-body" class="md:w-[65%] md:mx-auto py-10 px-10 md:px-0 min-h-[60vh]">
        <div class="flex justify-between">
            <h1 class="text-contrastGold text-5xl mb-4">Edit Persons</h1>
            <div class="items-end">
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6 mb-10">
            @include('admin.settings.gateway.persons._parts.form', ['verb' => 'Update'])
        </div>
    </section>

@endsection