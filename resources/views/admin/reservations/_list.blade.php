@if ($reservations->count() > 0)
    <table>
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
    <p>There are no reservations to show.</p>
@endif