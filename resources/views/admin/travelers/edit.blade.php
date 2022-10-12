@extends('_template')

@section('content')

    <section id="content-body" class="md:w-[65%] md:mx-auto py-10 px-10 md:px-0 min-h-[60vh]">
        <div class="flex justify-between">
            <h1 class="text-contrastGold text-5xl mb-4">Edit a Traveler</h1>
            <div class="items-end">
            </div>
        </div>

        <form action="{{ route('admin.travelers.update', $traveler) }}" method="post">
            @csrf
            @method('PATCh')

            @php
                $fillable = [
                    'first' => ['type' => 'text', 'required' => true],
                    'last' => ['type' => 'text', 'required' => true],
                    'email' => ['type' => 'text', 'required' => true],
                    'phone' => ['type' => 'text', 'required' => true],
                    'phone2' => ['type' => 'text', 'required' => false],
                    'address' => ['type' => 'text', 'required' => true],
                    'address2' => ['type' => 'text', 'required' => false],
                    'city' => ['type' => 'text', 'required' => true],
                    'state' => ['type' => 'text', 'required' => true],
                    'zip' => ['type' => 'text', 'required' => true],
                ];
            @endphp

            @foreach ($fillable as $k => $v)
                <label for="{{ $k }}"  class="block">{{ ucwords(str_replace('_', ' ', $k)) }}</label>
                @if ($v['type'] == 'text')
                    <input type="text" name="{{$k}}" id="{{$k}}" value="{{ old($k) ?: ($traveler->$k ?: '') }}" {{ $v['required'] ? 'required' : '' }} class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline" />
                @endif
                @error($k)
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            @endforeach

            <input type="submit" value="Update" class="bg-gold mx-auto mt-5 md:mx-0 hover:bg-darkGold text-black hover:text-white py-3 px-4 decoration-0 flex-nowrap">
        </form>
    </section>

@endsection