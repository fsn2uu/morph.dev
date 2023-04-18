@if ($specials->count() > 0)
    <table class="w-full">
        <thead>
            <th class="py-2 px-4">Unit</th>
            <th class="py-2 px-4">Neighborhood</th>
            <th class="py-2 px-4">Amount</th>
            <th class="py-2 px-4">Start</th>
            <th class="py-2 px-4">Expire</th>
            <th></th>
        </thead>
        <tbody>
            @foreach ($specials as $special)
                <tr>
                    <td class="py-2 px-4">{{ @$special->unit->name ?:'' }}</td>
                    <td class="py-2 px-4">{{ @$special->neighborhood->name ?:'' }}</td>
                    <td class="py-2 px-4 text-center">{{ $special->type == 'fixed' ? '$' : '' }}{{ $special->amount }}{{ $special->type = 'percentage' ? '%' : '' }}</td>
                    <td class="py-2 px-4 text-center">{{ $special->start_date }}</td>
                    <td class="py-2 px-4 text-center">{{ $special->end_date }}</td>
                    <td class="py-2 px-4">
                        <a href="{{ route('admin.specials.edit', $special) }}" class="text-white bg-blue-600 hover:bg-blue-800 p-2 pr-1 mr-2 rounded-sm">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <form action="{{ route('admin.specials.destroy', $special) }}" method="post" class="inline" onsubmit="return confirm('Are you sure?')">
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
    <div class="mt-5">
        {{ $specials->links() }}
    </div>
@else
    <p class="text-center">There are no specials to show.</p>
@endif