@if ($reservations->count() > 0)
    <table>
        <thead>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </thead>
        <tbody>
            @foreach ($reservations as $reservation)
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>There are no reservations to show.</p>
@endif