<x-app-layout>

    <section id="content-body" class="md:w-[65%] md:mx-auto py-10 px-10 md:px-0 min-h-[60vh]">
        <div class="flex justify-between">
            <h1 class="text-contrastGold text-5xl mb-4">Settings for {{ $company->name }}</h1>
            <div class="items-end">
            </div>
        </div>

        <p>Amount to be deposited: ${{ number_format($info->balance, 2) }}</p>
        <p>Your next billing date:  {{ \Carbon\Carbon::parse($info['subscriptions']['current_period_end'])->format('M d, Y') }}</p>
        <p>Current Subscriptions:</p>
        <ul class="mb-5">
            @foreach ($info['subscriptions']['data'] as $sub)
                <li>{{$sub['plan']['nickname']}}</li>
            @endforeach
        </ul>

        <p>Change Plan to:</p>
        <form action="{{ route('admin.settings.company', $company) }}" method="post">
            @csrf
            <label for="plan" class="block mb-5">Plan <span class="text-red-400">*</span>
                <select name="plan" id="plan" required class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                    <option value=""></option>
                    @foreach ($prices['data'] as $price)
                        <option value="{{ $price['id'] }}" {{ \Request::get('plan') == $price['id'] ? 'selected' : (old('plan') == $price['id'] ? 'selected' : '') }}>{{ $price['nickname'] }}</option>
                    @endforeach
                </select>
            </label>
            <input type="submit" value="save">
        </form>

        <h2 class="text-4xl mb-4 text-contrastGold">Banks</h2>
        <p class="mb-5">
            When depositing into your bank accounts, the system will first make deposits for full dollar amounts, then percentages.
        </p>
        <table>
            <thead>
                <tr>
                    <th class="p-5">Name</th>
                    <th class="p-5">Status</th>
                    <th class="p-5">Split</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($banks['data'] as $bank)
                    <tr>
                        <td class="px-5 py-2"><i class="fa-solid fa-building-columns fa-2xl mr-5"></i>{{ $bank['bank_name'] }}</td>
                        <td class="px-5 py-2 uppercase">{{ $bank['status'] }}</td>
                        <td class="px-5 py-2">{{ \App\Models\Bank::where('stripe_id', $bank['id'])->first()->split }}{{ \App\Models\Bank::where('stripe_id', $bank['id'])->first()->split_type == 'percent' ? '%' : '' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>

</x-app-layout>