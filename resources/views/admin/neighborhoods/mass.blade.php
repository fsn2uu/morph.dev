@extends('_template')

@section('content')

    <section id="content-body" class="md:w-[65%] md:mx-auto py-10 px-10 md:px-0 min-h-[60vh]">
        <div class="flex justify-between">
            <h1 class="text-contrastGold text-5xl mb-4">Mass Link Units to {{ $neighborhood->name }}</h1>
            <div class="items-end">
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-6 mb-10">
            <form action="{{ route('admin.neighborhoods.massAssignPost', $neighborhood) }}" method="post">
                @csrf
                <div class="grid grid-cols-4 gap-4">
                    @foreach($units as $unit)
                        <div>
                            <input type="checkbox" id="unit-{{ $unit->id }}" name="links[]" value="{{ $unit->id }}">
                            <label for="unit-{{ $unit->id }}" class="">
                                {{ $unit->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
                <input type="submit" value="Link" class="bg-gold mx-auto mt-5 md:mx-0 hover:bg-darkGold text-black hover:text-white py-3 px-4 decoration-0 flex-nowrap">
            </form>
        </div>
    </section>
    
@endsection