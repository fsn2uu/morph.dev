@extends('_template')

@section('content')

    <section id="content-body" class="md:w-[65%] md:mx-auto py-10 px-10 md:px-0 min-h-[60vh]">
        <div class="flex justify-between">
            <h1 class="text-contrastGold text-5xl mb-4">Units</h1>
            <div class="items-end">
                <a href="{{ route('admin.units.create') }}" class="bg-gold mx-auto md:mx-0 hover:bg-darkGold text-black hover:text-white py-3 px-4 decoration-0 flex-nowrap">Create</a>
            </div>
        </div>
        @if ($units->count() < 1)
            <p class="text-center">There are no units to show.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th class="py-2 px-4">Name</th>
                        <th class="py-2 px-4">Neighborhood</th>
                        <th class="py-2 px-4">Status</th>
                        <th class="py-2 px-4">Last Updated</th>
                        <th class="py-2 px-4"></th>
                        <tbody>
                            @foreach ($units as $unit)
                                <tr>
                                    <td class="py-2 px-4">
                                        <a href="{{ route('admin.units.show', $unit->slug) }}" class="underline text-blue-400">{{ $unit->name }}</a>
                                    </td>
                                    <td class="py-2 px-4 text-center">{{ $unit->neighborhood->name }}</td>
                                    <td class="py-2 px-4">{{ ucwords($unit->status) }}</td>
                                    <td class="py-2 px-4">{{ \Carbon\Carbon::parse($unit->updated_at)->format('Y-m-d') }}</td>
                                    <td class="py-2 px-4">
                                        <a href="{{ route('admin.units.edit', $unit->slug) }}" class="text-white bg-blue-600 hover:bg-blue-800 p-2 pr-1 mr-2 rounded-sm">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <form action="{{ route('admin.units.destroy', $unit) }}" method="post" class="inline" onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-white bg-red-600 hover:bg-red-800 px-2 py-1 rounded-sm">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </tr>
                </thead>
            </table>
            <div class="mt-5">
                {{ $units->links() }}
            </div>
        @endif
    </section>
    
@endsection