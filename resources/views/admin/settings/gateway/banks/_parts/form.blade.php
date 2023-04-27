<form action="{{ $verb == 'Create' ? route('admin.settings.gateway.banks.create') : route('admin.settings.gateway.banks.edit', $bank->id) }}" class="w-full">
    @csrf
    @if ($verb == 'Update')
        @method('PATCH')
    @endif
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label for="bank_name" class="block capitalize">Bank Name</label>
            <input type="text" name="bank_name" id="bank_name" value="{{ old('bank_name') ?: (@$bank->bank_name ?: '') }}" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div>
            <label for="account_holder_name" class="block capitalize">Account Holder Name</label>
            <input type="text" name="account_holder_name" id="account_holder_name" value="{{ old('account_holder_name') ?: (@$bank->account_holder_name ?: '') }}" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        @if ($verb == 'Create')
            <div>
                <label for="account_number" class="block capitalize">Account Number</label>
                <input type="text" name="account_number" id="account_number" value="{{ old('account_number') ?: (@$bank->account_number ?: '') }}" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
            </div>
        @endif
        <div>
            <label for="routing_number" class="block capitalize">Routing Number</label>
            <input type="text" name="routing_number" id="routing_number" value="{{ old('routing_number') ?: (@$bank->routing_number ?: '') }}" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
        </div>
    </div>

    <input type="submit" value="{{ $verb }}" class="bg-gold mx-auto mt-5 md:mx-0 hover:bg-darkGold text-black hover:text-white py-3 px-4 decoration-0 flex-nowrap">
</form>