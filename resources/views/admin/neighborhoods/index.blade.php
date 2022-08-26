@extends('_template')

@section('content')

    <section id="content-body" class="md:w-[65%] md:mx-auto py-10 px-10 md:px-0 min-h-[60vh]">
        <div class="flex justify-between">
            <h1 class="text-contrastGold text-5xl mb-4">Neighborhoods</h1>
            <div class="items-end">
                <a href="{{ route('admin.neighborhoods.create') }}" class="bg-gold mx-auto md:mx-0 hover:bg-darkGold text-black hover:text-white py-3 px-4 decoration-0 flex-nowrap">Create</a>
            </div>
        </div>
        @if ($neighborhoods->count() < 1)
            <p class="text-center">There are no neighborhoods to show.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th class="py-2 px-4">Name</th>
                        <th class="py-2 px-4"># Units</th>
                        <th class="py-2 px-4">Status</th>
                        <th class="py-2 px-4">Last Updated</th>
                        <th class="py-2 px-4"></th>
                        <tbody>
                            @foreach ($neighborhoods as $neighborhood)
                                <tr>
                                    <td class="py-2 px-4">
                                        <a href="{{ route('admin.neighborhoods.show', $neighborhood) }}" class="underline text-blue-400">{{ $neighborhood->name }}</a>
                                    </td>
                                    <td class="py-2 px-4 text-center">{{ $neighborhood->units->count() }}</td>
                                    <td class="py-2 px-4">{{ ucwords($neighborhood->status) }}</td>
                                    <td class="py-2 px-4">{{ \Carbon\Carbon::parse($neighborhood->updated_at)->format('Y-m-d') }}</td>
                                    <td class="py-2 px-4">
                                        <a href="{{ route('admin.neighborhoods.edit', $neighborhood) }}" class="text-white bg-blue-600 hover:bg-blue-800 p-2 pr-1 mr-2 rounded-sm">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <form action="{{ route('admin.neighborhoods.destroy', $neighborhood) }}" method="post" class="inline" onsubmit="return confirm('Are you sure?')">
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
                {{ $neighborhoods->links() }}
            </div>
        @endif
    </section>
    
@endsection