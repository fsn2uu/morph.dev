<x-guest-layout>

    <section id="content-body" class="md:w-[65%] md:mx-auto py-10 px-10 md:px-0">
        <form action="{{ route('register') }}" method="post" enctype="multipart/form-data">
            @csrf
            <h1 class="text-contrastGold text-5xl text-center mb-4">Get Started!</h1>
            <p class="mb-2">
                * Required fields are marked
            </p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                <label for="plan" class="block mb-5">Plan <span class="text-red-400">*</span>
                    <select name="plan" id="plan" required class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                        <option value=""></option>
                        <option>Plan 1</option>
                        <option>Plan 2</option>
                        <option>Plan 3</option>
                    </select>
                </label>
                <label for="additional_neighborhoods" class="block mb-5">Additional Neighborhoods
                    <select name="additional_neighborhoods" id="additional_neighborhoods" required class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                        <option value=""></option>
                        @for ($i = 1; $i < 50; $i++)
                            <option>{{ $i }}</option>
                        @endfor
                    </select>
                </label>
                <label for="additional_units" class="block mb-5">Additional Units
                    <select name="additional_units" id="additional_units" required class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                        <option value=""></option>
                        @for ($i = 1; $i < 50; $i++)
                            <option>{{ $i }}</option>
                        @endfor
                    </select>
                </label>
            </div>
            <h2 class="text-contrastGold text-3xl text-center mb-4">Tell Us About Yourself</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                <label for="fname" class="block mb-5">First Name <span class="text-red-400">*</span>
                    <input type="text" name="fname" id="fname" required class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                </label>
                <label for="lname" class="block mb-5">Last Name <span class="text-red-400">*</span>
                    <input type="text" name="lname" id="lname" required class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                </label>
                <label for="email" class="block mb-5">Email Address <span class="text-red-400">*</span>
                    <input type="text" name="email" id="email" required class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                </label>
                <label for="phone" class="block mb-5">Phone <span class="text-red-400">*</span>
                    <input type="text" name="phone" id="phone" required class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                </label>
                <label for="phone2" class="block mb-5">Alt Phone
                    <input type="text" name="phone2" id="phone2" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                </label>
                <label for="password" class="block mb-5">Password <span class="text-red-400">*</span>
                    <input type="text" name="password" id="password" required class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                </label>
                <label for="password_confirmation" class="block mb-5">Confirm Password <span class="text-red-400">*</span>
                    <input type="text" name="password_confirmation" id="password_confirmation" required class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                </label>
            </div>
            <h2 class="text-contrastGold text-3xl text-center mb-4">Tell Us About Your Company</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                <label for="name" class="block mb-5">Company Name <span class="text-red-400">*</span>
                    <input type="text" name="name" id="name" required class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                </label>
                <label for="address" class="block mb-5">Address <span class="text-red-400">*</span>
                    <input type="text" name="address" id="address" required class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                </label>
                <label for="address2" class="block mb-5">Address 2
                    <input type="text" name="address2" id="address2" required class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                </label>
                <label for="city" class="block mb-5">City <span class="text-red-400">*</span>
                    <input type="text" name="city" id="city" required class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                </label>
                <label for="state" class="block mb-5">State <span class="text-red-400">*</span>
                    <input type="text" name="state" id="state" required class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                </label>
                <label for="zip" class="block mb-5">Zip <span class="text-red-400">*</span>
                    <input type="text" name="zip" id="zip" required class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                </label>
                <label for="website" class="block mb-5">Website
                    <input type="text" name="website" id="website" required class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                </label>
                <label for="phone" class="block mb-5">Phone
                    <input type="text" name="phone" id="phone" required class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                </label>
                <label for="phone2" class="block mb-5">Alt Phone
                    <input type="text" name="phone2" id="phone2" required class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                </label>
                <label for="toll_free" class="block mb-5">Toll-free
                    <input type="text" name="toll_free" id="toll_free" required class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                </label>
                <label for="logo" class="block mb-5">Company Logo
                    <input type="file" name="logo" id="logo" required class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                </label>
            </div>
            <label for="accepted_terms" class="block mb-5">
                <input type="checkbox" value="1" required name="accepted_terms" id="accepted_terms" class="shadow appearance-none border border-[#ccc] bg-white mb-2 rounded p-2 leading-tight focus:outline-none focus:shadow-outline">
                <span class="text-red-400">*</span> Click here to accept the <a href="{{ route('tos') }}" target="_blank" class="underline text-blue-400">Terms of Service</a> for Morph Digital.
            </label>
            <label for="acknowledged_legality" class="block mb-5">
                <input type="checkbox" value="1" required name="acknowledged_legality" id="acknowledged_legality" class="shadow appearance-none border border-[#ccc] bg-white mb-2 rounded p-2 leading-tight focus:outline-none focus:shadow-outline">
                <span class="text-red-400">*</span> Click here to certify that you are legally able to use this service as required by local, state, and other applicable law.
            </label>
            <input type="submit" value="Let's Go!" class="nav bg-gold hover:bg-darkGold text-black hover:text-white py-3 px-4 decoration-0 flex-nowrap">
        </form>
    </section>
    
</x-guest-layout>