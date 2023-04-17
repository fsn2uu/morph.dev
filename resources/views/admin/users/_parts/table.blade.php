<table>
    <thead>
        <tr>
            <th class="py-2 px-4">Last Name</th>
            <th class="py-2 px-4">First Name</th>
            <th class="py-2 px-4">Email</th>
            <th class="py-2 px-4">Role</th>
            <th class="py-2 px-4"></th>
            <tbody>
                @foreach ($users as $user)
                    <tr class="mb-2">
                        <td class="py-2 px-4">
                            <a href="{{ route('admin.users.show', $user) }}" class="underline text-blue-400">{{ $user->lname }}</a>
                        </td>
                        <td class="py-2 px-4">
                            <a href="{{ route('admin.users.show', $user) }}" class="underline text-blue-400">{{ $user->fname }}</a>
                        </td>
                        <td class="py-2 px-4">{{ $user->email }}</td>
                        <td class="py-2 px-4">{{ ucwords($user->getRoleNames()->first()) }}</td>
                        <td class="py-2 px-4">
                            <a href="{{ route('admin.users.edit', $user) }}" class="text-white bg-blue-600 hover:bg-blue-800 p-2 pr-1 mr-2 rounded-sm">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <form action="{{ route('admin.users.destroy', $user) }}" method="post" class="inline" onsubmit="return confirm('Are you sure?')">
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
        </tr>
    </thead>
</table>
<div class="mt-5">
    {{ $users->links() }}
</div>