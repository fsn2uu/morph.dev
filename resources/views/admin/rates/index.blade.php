@extends('_template')

@section('content')

    <section id="content-body" class="md:w-[65%] md:mx-auto py-10 px-10 md:px-0 min-h-[60vh]">
        <div class="flex justify-between">
            <h1 class="text-contrastGold text-5xl mb-4">Rate Tables</h1>
            <div class="items-end">
                <a href="{{ route('admin.rates.create') }}" class="bg-gold mx-auto md:mx-0 hover:bg-darkGold text-black hover:text-white py-3 px-4 decoration-0 flex-nowrap">Create</a>
            </div>
        </div>

        @if ($rate_tables->count() > 0)
            <table>
                <thead>
                    <th>Title</th>
                </thead>
                <tbody>
                    @foreach($rate_tables as $table)
                        <tr>
                            <td><a href="{{ route('admin.rates.edit', $table->id) }}" class="text-blue-400 underline">{{ $table->name }}</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-center">There are no rate tables to display.</p>
        @endif
    </section>

@endsection