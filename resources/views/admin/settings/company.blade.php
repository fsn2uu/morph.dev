<x-app-layout>

    <section id="content-body" class="md:w-[65%] md:mx-auto py-10 px-10 md:px-0 min-h-[60vh]">
        <div class="flex justify-between">
            <h1 class="text-contrastGold text-5xl mb-4">Company Settings</h1>
            <div class="items-end">
            </div>
        </div>

        <p>Amount to be deposited: ${{ number_format($info->balance, 2) }}</p>
        <p>Your next billing date:  {{ \Carbon\Carbon::parse($info['subscriptions']['current_period_end'])->format('M d, Y') }}</p>
        <p>Current Subscriptions:</p>
        <ul>
            @foreach ($info['subscriptions']['data'] as $sub)
                <li>{{$sub['plan']['nickname']}}</li>
            @endforeach
        </ul>
    </section>

</x-app-layout>