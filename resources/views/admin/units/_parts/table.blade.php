<div class="py-8">
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
        @foreach ($units as $unit)
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <img src="{{ $unit->pics->count() > 0 ? asset($unit->pics->first()->filename) : '' }}" alt="{{ @$unit->pics->first()->alt ? 'Picture of ' . $unit->name : '' }}" class="w-full h-48 object-cover">
                <div class="p-4">
                    <a href="{{ route('admin.units.show', $unit->slug) }}" class="text-lg font-semibold text-blue-400 hover:underline">{{ $unit->name }}</a>
                    <p class="text-sm text-gray-600">{{ $unit->neighborhood ? $unit->neighborhood->name : '' }}</p>
                    <div class="flex items-center mt-2">
                        <div class="mr-2">
                            <span class="font-semibold">Beds:</span> {{ $unit->beds }}
                        </div>
                        <div class="mr-2">
                            <span class="font-semibold">Baths:</span> {{ $unit->baths }}
                        </div>
                        <div class="mr-2">
                            <span class="font-semibold">Sleeps:</span> {{ $unit->sleeps }}
                        </div>
                    </div>
                    <p class="text-sm mt-2">Status: {{ ucwords($unit->status) }}</p>
                    <p class="text-sm text-gray-600">Last Updated: {{ \Carbon\Carbon::parse($unit->updated_at)->format('Y-m-d') }}</p>
                    <div class="mt-4 flex justify-end">
                        <a href="{{ route('admin.units.edit', $unit->slug) }}" class="text-white bg-blue-600 hover:bg-blue-800 px-3 py-2 rounded-sm">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <form action="{{ route('admin.units.destroy', $unit) }}" method="post" class="ml-2 inline" onsubmit="return confirm('Are you sure?')">
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
        {{ $units->links() }}
    </div>
</div>
