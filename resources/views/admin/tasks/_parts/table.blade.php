<div class="py-8">
    <div class="w-full mx-auto">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                @if ($tasks->count() > 0)
                    <table class="w-full">
                        <thead>
                            <th class="py-2 px-4">Title</th>
                            <th class="py-2 px-4">Unit</th>
                            <th class="py-2 px-4">Neighborhood</th>
                            <th class="py-2 px-4">Status</th>
                            <th class="py-2 px-4">Start</th>
                            <th class="py-2 px-4">Expire</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                                <tr>
                                    <td class="py-2 px-4">{{ @$task->name ?:'' }}</td>
                                    <td class="py-2 px-4">{{ @$task->unit->name ?:'' }}</td>
                                    <td class="py-2 px-4">{{ @$task->neighborhood->name ?:'' }}</td>
                                    <td class="py-2 px-4 text-center">{{ $task->status }}</td>
                                    <td class="py-2 px-4 text-center">{{ $task->start_date }}</td>
                                    <td class="py-2 px-4 text-center">{{ $task->end_date }}</td>
                                    <td class="py-2 px-4">
                                        <a href="{{ route('admin.tasks.edit', $task) }}" class="text-white bg-blue-600 hover:bg-blue-800 p-2 pr-1 mr-2 rounded-sm">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <form action="{{ route('admin.tasks.destroy', $task) }}" method="post" class="inline" onsubmit="return confirm('Are you sure?')">
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
                        {{ $tasks->links() }}
                    </div>
                @else
                    <p class="text-center">There are no tasks to show.</p>
                @endif
            </div>
        </div>
    </div>
</div>