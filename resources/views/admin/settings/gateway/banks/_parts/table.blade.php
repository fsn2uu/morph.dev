@if (sizeof($banks->data > 0))
    <table class="w-full">
        <thead>
            <th class="py-2 px-4">Bank</th>
            <th class="py-2 px-4">Account Holder</th>
            <th class="py-2 px-4">Routing / Account</th>
            <th class="py-2 px-4">Status</th>
        </thead>
        <tbody>
            @foreach ($banks->data as $bank)
                <tr>
                    <td class="py-2 px-4">{{ $bank->bank_name }}</td>
                    <td class="py-2 px-4 text-center">{{ $bank->account_holder_name }}</td>
                    <td class="py-2 px-4 text-center">{{ substr_replace(str_repeat('*', strlen($bank->routing_number) - 4), substr($bank->routing_number, -4), 0) }}</td>
                    <td class="py-2 px-4 capitalize text-center">{{ $bank->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p class="text-center">There are no banks to show.</p>
@endif