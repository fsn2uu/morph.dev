<div class="py-8">
    <div class="w-full mx-auto">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                @if ($neighborhoods->count() > 0)
                    <table class="w-full">
                        <thead>
                            <tr>
                                <th class="py-2 px-4"></th>
                                <th class="py-2 px-4">Name</th>
                                <th class="py-2 px-4"># Units</th>
                                <th class="py-2 px-4">Status</th>
                                <th class="py-2 px-4">Last Updated</th>
                                <th class="py-2 px-4"></th>
                                <tbody>
                                    @foreach ($neighborhoods as $neighborhood)
                                        <tr>
                                            <td class="py-2 px-4">
                                                <img src="{{ asset($neighborhood->pics->first()->filename) }}" alt="{{ $neighborhood->pics->first()->alt ? 'Picture of '. $neighborhood->name : '' }}" width="90">
                                            </td>
                                            <td class="py-2 px-4">
                                                <a href="{{ route('admin.neighborhoods.show', $neighborhood->slug) }}" class="underline text-blue-400">{{ $neighborhood->name }}</a>
                                            </td>
                                            <td class="py-2 px-4 text-center">{{ $neighborhood->units->count() }}</td>
                                            <td class="py-2 px-4">{{ ucwords($neighborhood->status) }}</td>
                                            <td class="py-2 px-4">{{ \Carbon\Carbon::parse($neighborhood->updated_at)->format('Y-m-d') }}</td>
                                            <td class="py-2 px-4">
                                                <a href="{{ route('admin.neighborhoods.edit', $neighborhood->slug) }}" class="text-white bg-blue-600 hover:bg-blue-800 p-2 pr-1 mr-2 rounded-sm">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                                <form action="{{ route('admin.neighborhoods.destroy', $neighborhood->slug) }}" method="post" class="inline" onsubmit="return confirm('Are you sure?')">
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
                @else
                    <p class="text-centered">There are no neighborhoods to show.</p>
                @endif
            </div>
        </div>
    </div>
</div>