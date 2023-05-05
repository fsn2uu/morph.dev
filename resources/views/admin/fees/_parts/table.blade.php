<div class="py-8">
    <div class="w-full mx-auto">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                @if ($fees->count() > 0)
                    <table class="w-full">
                        <thead>
                            <th class="py-2 px-4">Name</th>
                            <th class="py-2 px-4">Percentage</th>
                            <th class="py-2 px-4">Amount</th>
                            <th class="py-2 px-4">Attached To</th>
                            <th class="py-2 px-4"></th>
                        </thead>
                        <tbody>
                            @foreach($fees as $fee)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $fee->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $fee->percentage ? $fee->percentage.'%' : '' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $fee->amount ? '$'.$fee->amount : '' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($fee->feeable_type === 'App\Models\Company')
                                            Company
                                        @elseif ($fee->feeable_type === 'App\Models\Unit')
                                            <a href="{{ route('admin.units.index', ['id' => $fee->feeable_id]) }}" class="text-blue-500 hover:text-blue-700 underline">{{ $fee->feeable->name }}</a>
                                        @elseif ($fee->feeable_type === 'App\Models\Neighborhood')
                                            <a href="{{ route('admin.neighborhoods.index', ['id' => $fee->feeable_id]) }}" class="text-blue-500 hover:text-blue-700 underline">{{ $fee->feeable->name }}</a>
                                        @endif
                                    </td>
                                    <td class="py-2 px-4">
                                        <a href="{{ route('admin.fees.edit', $fee) }}" class="text-white bg-blue-600 hover:bg-blue-800 p-2 pr-1 mr-2 rounded-sm">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <form action="{{ route('admin.fees.destroy', $fee) }}" method="post" class="inline" onsubmit="return confirm('Are you sure?')">
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
                    <p class="text-center">There are no fees to display.</p>
                @endif
            </div>
        </div>
    </div>
</div>