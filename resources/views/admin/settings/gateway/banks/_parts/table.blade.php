@if (!empty($banks->data))
    <table class="w-full">
        <thead>
            <th class="py-2 px-4">Bank</th>
            <th class="py-2 px-4">Account Holder</th>
            <th class="py-2 px-4">Routing / Account</th>
            <th class="py-2 px-4">Status</th>
            <th class="py-2 px-4"></th>
        </thead>
        <tbody>
            @foreach ($banks->data as $bank)
                <tr>
                    <td class="py-2 px-4">{{ $bank->bank_name }}</td>
                    <td class="py-2 px-4 text-center">{{ $bank->account_holder_name }}</td>
                    <td class="py-2 px-4 text-center">{{ substr_replace(str_repeat('*', strlen($bank->routing_number) - 4), substr($bank->routing_number, -4), 0) }}</td>
                    <td class="py-2 px-4 capitalize text-center">{{ $bank->status }}</td>
                    <td class="py-2 px-4">
                        <a href="{{ route('admin.settings.gateway.banks.edit', $bank->id) }}" class="text-white bg-blue-600 hover:bg-blue-800 p-2 pr-1 mr-2 rounded-sm">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <form action="{{ route('admin.settings.gateway.banks.destroy', $bank->id) }}" method="post" class="inline" onsubmit="return confirm('Are you sure?')">
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
    <p class="text-center">There are no banks to show.</p>
@endif