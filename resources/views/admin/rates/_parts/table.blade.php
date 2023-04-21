<div class="py-8">
    <div class="w-full mx-auto">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                @if ($rate_tables->count() > 0)
                    <table class="w-full">
                        <thead>
                            <th class="py-2 px-4">Title</th>
                            <th class="py-2 px-4">Neighborhood</th>
                            <th class="py-2 px-4">Unit</th>
                            <th class="py-2 px-4"></th>
                        </thead>
                        <tbody>
                            @foreach($rate_tables as $table)
                                <tr>
                                    <td class="py-2 px-4"><a href="{{ route('admin.rates.edit', $table->id) }}" class="text-blue-400 underline">{{ $table->name }}</a></td>
                                    <td class="py-2 px-4">{{ @$table->neighborhood->name }}</td>
                                    <td class="py-2 px-4">{{ @$table->unit->name }}</td>
                                    <td class="py-2 px-4">
                                        <a href="{{ route('admin.rates.edit', $table) }}" class="text-white bg-blue-600 hover:bg-blue-800 p-2 pr-1 mr-2 rounded-sm">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <form action="{{ route('admin.rates.destroy', $table) }}" method="post" class="inline" onsubmit="return confirm('Are you sure?')">
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
                    </table>
                @else
                    <p class="text-center">There are no rate tables to display.</p>
                @endif
            </div>
        </div>
    </div>
</div>