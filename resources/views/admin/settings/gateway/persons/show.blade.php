@extends('_template')

@section('content')

    <section id="content-body" class="md:w-[65%] md:mx-auto py-10 px-10 md:px-0 min-h-[60vh]">
        <div class="flex justify-between">
            <h1 class="text-contrastGold text-5xl mb-4">Edit Persons: {{ "$person->first_name $person->last_name" }}</h1>
            <div class="items-end">
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6 mb-10">
            @if ($person->status != 'verified')
                @if ($person->verification->details_code == 'failed_keyed_identity')
                    <p class="text-center">There was a problem verifying your identity.  Please <a href="{{ route('admin.gateway.persons.edit', $user) }}" class="text-blue-400 underline">edit your information</a> and re-submit.</p>                
                @else
                    <p class="text-center">There are requirements from the payment processor that must be satisfied to verify this user:</p>
                    <ul>
                        @foreach ($person->requirements->past_due as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                @endif
            @endif
        </div>
    </section>

@endsection