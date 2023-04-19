@extends('_template')

@section('content')

    <section id="content-body" class="md:w-[65%] md:mx-auto py-10 px-10 md:px-0 min-h-[60vh]">
        <div class="flex justify-between">
            <h1 class="text-contrastGold text-5xl mb-4">Create a Task</h1>
            <div class="items-end">
            </div>
        </div>

        @include('admin.tasks._parts.form', ['verb' => 'Create'])
    </section>

@endsection