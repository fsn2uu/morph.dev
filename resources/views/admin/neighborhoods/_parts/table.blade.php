<div class="py-8">
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
        @foreach ($neighborhoods as $neighborhood)
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <img src="{{ asset($neighborhood->pics->first()->filename) }}" alt="{{ $neighborhood->pics->first()->alt ? 'Picture of ' . $neighborhood->name : '' }}" class="w-full h-48 object-cover">
                <div class="p-4">
                    <a href="{{ route('admin.neighborhoods.show', $neighborhood->slug) }}" class="text-lg font-semibold text-blue-400 hover:underline">{{ $neighborhood->name }}</a>
                    <p class="text-sm mt-2">Units: {{ $neighborhood->units->count() }}</p>
                    <p class="text-sm mt-2">Status: {{ ucwords($neighborhood->status) }}</p>
                    <p class="text-sm text-gray-600">Last Updated: {{ \Carbon\Carbon::parse($neighborhood->updated_at)->format('Y-m-d') }}</p>
                    <div class="mt-4 flex justify-end">
                        <a href="{{ route('admin.neighborhoods.massAssign', $neighborhood) }}" class="text-white bg-green-600 hover:bg-green-800 px-3 py-2 rounded-sm"><i class="fa-solid fa-network-wired"></i></a>
                        <a href="{{ route('admin.neighborhoods.edit', $neighborhood->slug) }}" class="text-white bg-blue-600 hover:bg-blue-800 px-3 py-2 rounded-sm ml-2">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <form action="{{ route('admin.neighborhoods.destroy', $neighborhood->slug) }}" method="post" class="ml-2 inline" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button class="text-white bg-red-600 hover:bg-red-800 px-3 py-2 rounded-sm">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="mt-5">
        {{ $neighborhoods->links() }}
    </div>
</div>
