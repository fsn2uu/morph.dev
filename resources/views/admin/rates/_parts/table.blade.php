<div class="py-8">
    <div class="w-full mx-auto">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                @if ($rate_tables->count() > 0)
                    <table class="w-full">
                        <thead>
                            <th>Title</th>
                        </thead>
                        <tbody>
                            @foreach($rate_tables as $table)
                                <tr>
                                    <td><a href="{{ route('admin.rates.edit', $table->id) }}" class="text-blue-400 underline">{{ $table->name }}</a></td>
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