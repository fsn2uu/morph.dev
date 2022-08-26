@extends('_template')

@section('content')

    <section id="content-body" class="md:w-[65%] md:mx-auto py-10 px-10 md:px-0 min-h-[60vh]">
        <div class="flex justify-between">
            <h1 class="text-contrastGold text-5xl mb-4">Users</h1>
            <div class="items-end">
                <a href="{{ route('admin.users.create') }}" class="bg-gold mx-auto md:mx-0 hover:bg-darkGold text-black hover:text-white py-3 px-4 decoration-0 flex-nowrap">Create</a>
            </div>
        </div>
        @if ($users->count() < 1)
            <p class="text-center">There are no users to show.</p>
        @else
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
        @endif
    </section>
    
@endsection