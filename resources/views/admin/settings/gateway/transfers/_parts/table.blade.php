@if (sizeof($transfers->data) > 0)
    <table class="w-full">
        <thead>
            <th class="py-2 px-4">Description</th>
            <th class="py-2 px-4">Amount</th>
            <th class="py-2 px-4">Created</th>
        </thead>
        <tbody>
            @foreach ($transfers->data as $transfer)
                <tr>
                    <td class="py-2 px-4">
                        <a href="{{ route('admin.settings.gateway.transfers.show', $transfer->id) }}" class="text-blue-400 underline">{{ $transfer->description }}</a>
                    </td>
                    <td class="py-2 px-4 text-right">${{ $transfer->amount / 100 }}</td>
                    <td class="py-2 px-4 text-right">{{ \Carbon\Carbon::parse($transfer->created)->format('Y-m-d') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p class="text-center">There are no transfers to show.</p>
@endif