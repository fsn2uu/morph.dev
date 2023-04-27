@extends('_template')

@section('content')
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
        {{-- <form action="{{ route('admin.settings.company', $company) }}" method="post">
            @csrf
            <label for="plan" class="block mb-5">Plan <span class="text-red-400">*</span>
                <select name="plan" id="plan" required class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                    <option value=""></option>
                    @foreach ($prices['data'] as $price)
                        <option value="{{ $price['id'] }}" {{ \Request::get('plan') == $price['id'] ? 'selected' :  (auth()->user()->company->hasStripeSubscription($price['nickname']) ? 'selected' : (old('plan') == $price['id'] ? 'selected' : '')) }}>{{ $price['nickname'] }}</option>
                    @endforeach
                </select>
            </label>
            <input type="submit" value="save">
        </form> --}}

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

        <div id="api-key-container" class="border-2 border-gray-300 p-4 rounded-lg cursor-pointer">
            <div class="flex justify-between items-center mb-4">
              <h2 class="text-lg font-semibold">{{ env('APP_NAME') }} API Key</h2>
              <button id="copy-api-key-button" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                Copy
              </button>
            </div>
            <p id="api-key" class="text-gray-700 font-mono">{{ Auth::user()->company->api_token }}</p>
          </div>

        <div class="flex justify-between">
            <div class="py-2 px-4 items-center">
                <a href="{{ route('admin.settings.gateway.banks.index') }}">
                    <i class="fa-solid fa-building-columns fa-2xl mr-5"></i>
                </a>
            </div>
            <div class="py-2 px-4">
                <a href="{{ route('admin.settings.gateway.persons.index') }}">
                    <i class="fa-solid fa-user fa-2xl mr-5"></i>
                </a>
            </div>
            <div class="py-2 px-4">
                <a href="{{ route('admin.settings.gateway.transfers.index') }}">
                    <i class="fa-solid fa-money-bill-transfer fa-2xl mr-5"></i>
                </a>
            </div>
        </div>
          
    </section>

@endsection

@push('scripts')
    <script>
        const apiKeyContainer = document.getElementById('api-key-container');
        const copyApiKeyButton = document.getElementById('copy-api-key-button');
        const apiKey = document.getElementById('api-key').textContent.trim();

        apiKeyContainer.addEventListener('click', () => {
            console.log('clicked the container')
        navigator.clipboard.writeText(apiKey)
            .then(() => {
            const flashMessage = document.createElement('div');
            flashMessage.textContent = 'Copied to Clipboard!';
            flashMessage.classList.add('absolute', 'inset-x-0', 'top-0', 'bg-green-400', 'text-white', 'py-2', 'text-center', 'font-bold', 'rounded-lg');
            apiKeyContainer.appendChild(flashMessage);
            setTimeout(() => {
                apiKeyContainer.removeChild(flashMessage);
            }, 3000);
            })
            .catch(err => {
            console.error('Failed to copy text: ', err);
            });
        });

        copyApiKeyButton.addEventListener('click', () => {
            console.log('clicked the button')
        navigator.clipboard.writeText(apiKey)
            .then(() => {
            const flashMessage = document.createElement('div');
            flashMessage.textContent = 'Copied to Clipboard!';
            flashMessage.classList.add('absolute', 'inset-x-0', 'top-0', 'bg-green-400', 'text-white', 'py-2', 'text-center', 'font-bold', 'rounded-lg');
            apiKeyContainer.appendChild(flashMessage);
            setTimeout(() => {
                apiKeyContainer.removeChild(flashMessage);
            }, 3000);
            })
            .catch(err => {
            console.error('Failed to copy text: ', err);
            });
        });


    </script>
        
    @endpush