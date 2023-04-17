<table class="w-full mt-10">
    <thead>
        <tr>
            <th class="py-2 px-4"></th>
            <th class="py-2 px-4">Name</th>
            <th class="py-2 px-4">Neighborhood</th>
            <th class="py-2 px-4">Beds</th>
            <th class="py-2 px-4">Baths</th>
            <th class="py-2 px-4">Sleeps</th>
            <th class="py-2 px-4">Status</th>
            <th class="py-2 px-4">Last Updated</th>
            <th class="py-2 px-4"></th>
            <tbody>
                @foreach ($units as $unit)
                    <tr>
                        <td class="py-2 px-4"><img src="{{ asset($unit->pics->first()->filename) }}" alt="{{ $unit->pics->first()->alt ? 'Picture of ' . $unit->name : '' }}" width="90"></td>
                        <td class="py-2 px-4">
                            <a href="{{ route('admin.units.show', $unit->slug) }}" class="underline text-blue-400">{{ $unit->name }}</a>
                        </td>
                        <td class="py-2 px-4 text-center">{{ $unit->neighborhood ?$unit->neighborhood->name :'' }}</td>
                        <td class="py-2 px-4 text-center">{{ $unit->beds }}</td>
                        <td class="py-2 px-4 text-center">{{ $unit->baths }}</td>
                        <td class="py-2 px-4 text-center">{{ $unit->sleeps }}</td>
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