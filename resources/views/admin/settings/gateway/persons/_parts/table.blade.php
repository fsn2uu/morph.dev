<div class="py-8">
    <div class="w-full mx-auto">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                <p class="mb-2">Deleting a person from the gateway does not remove their user account from {{ env('APP_NAME') }}, however, deleting a user will remove them as an authorized agent for the payment gateway.  Persons attached to the gateway are able to make monetary desicions about your business.</p>
                @if (sizeof($persons['data']) > 0)
                    <table class="w-full">
                        <thead>
                            <tr>
                                <th class="py-2 px-4">Name</th>
                                <th class="py-2 px-4">Email</th>
                                <th class="py-2 px-4">Relationship</th>
                                <th class="py-2 px-4">Status</th>
                                <th class="py-2 px-4"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($persons['data'] as $person)
                                <tr>
                                    <td class="py-2 px-4">{{ $person->first_name }} {{ $person->last_name }}</td>
                                    <td class="py-2 px-4">{{ $person->email }}</td>
                                    <td class="py-2 px-4 text-center">
                                        @php
                                            if ($person->relationship->director == true)
                                            {
                                                echo 'Director';
                                            }
                                            elseif($person->relationship->owner == true)
                                            {
                                                echo 'Owner' . ($person->relationship->percent_ownership != '' ? ' ('.$person->relationship->percent_ownership.'%)' : '');
                                            }
                                            elseif($person->relationship->executive == true)
                                            {
                                                echo 'Executive';
                                            }
                                            elseif($person->relationship->representative == true)
                                            {
                                                echo 'Representative';
                                            }
                                            else
                                            {
                                                echo $person->relationship->title;
                                            }
                                        @endphp
                                    </td>
                                    <td class="py-2 px-4 capitalize text-center">{{ $person->verification->status }}</td>
                                    <td class="py-2 px-4">
                                        @php
                                            $user = App\Models\User::where('stripe_id', $person->id)->first();
                                        @endphp
                                        @if($user)
                                            <a href="{{ route('admin.settings.gateway.persons.edit', $user) }}" class="text-white bg-blue-600 hover:bg-blue-800 p-2 pr-1 mr-2 rounded-sm">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                        @endif
                                            <form action="{{ route('admin.settings.gateway.persons.destroy', $person->id) }}" method="post" class="inline" onsubmit="return confirm('Are you sure?')">
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
                    <p class="text-center">There are no persons to show.</p>
                @endif
            </div>
        </div>
    </div>
</div>