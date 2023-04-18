<div class="py-8">
    <div class="w-full mx-auto">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                @if ($reservations->count() > 0)
                    <table class="w-full">
                        <thead>
                            <th class="py-2 px-4">Unit</th>
                            <th class="py-2 px-4">Traveler</th>
                            <th class="py-2 px-4">Traveler Phone</th>
                            <th class="py-2 px-4">Traveler Email</th>
                            <th class="py-2 px-4">Dates</th>
                        </thead>
                        <tbody>
                            @foreach ($reservations as $reservation)
                                <tr>
                                    <td class="py-2 px-4">{{ $reservation->unit->name }}</td>
                                    <td class="py-2 px-4">{{ $reservation->traveler->last }}, {{ $reservation->traveler->first }}</td>
                                    <td class="py-2 px-4">{{ $reservation->traveler->phone }}</td>
                                    <td class="py-2 px-4">{{ $reservation->traveler->email }}</td>
                                    <td class="py-2 px-4">{{ $reservation->start_date }} - {{ $reservation->end_date }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-center">There are no reservations to show.</p>
                @endif
            </div>
        </div>
    </div>
</div>