<div class="py-8">
    <div class="w-full mx-auto">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                @if ($travelers->count() > 0)
                    <table class="w-full">
                        <thead>
                            <tr>
                                <th class="py-2 px-4">Last Name</th>
                                <th class="py-2 px-4">First Name</th>
                                <th class="py-2 px-4">Email</th>
                                <th class="py-2 px-4">Phone</th>
                                <th class="py-2 px-4"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($travelers as $traveler)
                                <tr>
                                    <td class="py-2 px-4">{{ $traveler->last }}</td>
                                    <td class="py-2 px-4">{{ $traveler->first }}</td>
                                    <td class="py-2 px-4">{{ $traveler->email }}</td>
                                    <td class="py-2 px-4">{{ $traveler->phone }}</td>
                                    <td class="py-2 px-4">
                                        <a href="{{ route('admin.travelers.show', $traveler) }}" class="text-white bg-green-600 hover:bg-green-800 p-2 pr-1 mr-2 rounded-sm">
                                            <i class="fa-solid fa-binoculars"></i>
                                        </a>
                                        <a href="{{ route('admin.travelers.edit', $traveler) }}" class="text-white bg-blue-600 hover:bg-blue-800 p-2 pr-1 mr-2 rounded-sm">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <form action="{{ route('admin.travelers.destroy', $traveler) }}" method="post" class="inline" onsubmit="return confirm('Are you sure?')">
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
                    <p class="text-center">There are no travelers to display.</p>
                @endif
            </div>
        </div>
    </div>
</div>