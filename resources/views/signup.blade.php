<x-guest-layout>

    <section id="content-body" class="md:w-[65%] md:mx-auto py-10 px-10 md:px-0">
        <form action="{{ route('signup.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <h1 class="text-contrastGold text-5xl text-center mb-4">Get Started!</h1>
            <p class="mb-2">
                * Required fields are marked
            </p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                <label for="plan" class="block mb-5">Plan <span class="text-red-400">*</span>
                    <select name="plan" id="plan" required class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                        <option value=""></option>
                        @foreach ($prices['data'] as $price)
                            <option value="{{ $price['id'] }}" {{ \Request::get('plan') == $price['id'] ? 'selected' : (old('plan') == $price['id'] ? 'selected' : '') }}>{{ $price['nickname'] }}</option>
                        @endforeach
                    </select>
                </label>
                @error('plan')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
                <label for="additional_neighborhoods" class="block mb-5">Additional Neighborhoods
                    <select name="additional_neighborhoods" id="additional_neighborhoods" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                        <option value=""></option>
                        @for ($i = 1; $i < 50; $i++)
                            <option {{ old('additional_neighborhoods') == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </label>
                <label for="additional_units" class="block mb-5">Additional Units
                    <select name="additional_units" id="additional_units" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                        <option value=""></option>
                        @for ($i = 1; $i < 50; $i++)
                            <option {{ old('additional_units') == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </label>
            </div>
            <h2 class="text-contrastGold text-3xl text-center mb-4">Tell Us About Yourself</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                <label for="fname" class="block mb-5">First Name <span class="text-red-400">*</span>
                    <input type="text" name="fname" id="fname" required value="{{ old('fname') }}" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                </label>
                @error('fname')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
                <label for="lname" class="block mb-5">Last Name <span class="text-red-400">*</span>
                    <input type="text" name="lname" id="lname" required value="{{old('lname')}}" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                </label>
                @error('lname')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
                <label for="email" class="block mb-5">Email Address <span class="text-red-400">*</span>
                    <input type="text" name="email" id="email" required value="{{old('email')}}" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                </label>
                @error('email')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
                <label for="phone" class="block mb-5">Phone <span class="text-red-400">*</span>
                    <input type="text" name="phone" id="phone" required value="{{old('phone')}}" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                </label>
                @error('phone')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
                <label for="phone2" class="block mb-5">Alt Phone
                    <input type="text" name="phone2" id="phone2" value="{{ old('phone2') }}" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                </label>
                <label for="password" class="block mb-5">Password <span class="text-red-400">*</span>
                    <input type="text" name="password" id="password" required value="{{old('password')}}" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                </label>
                @error('password')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
                <label for="password_confirmation" class="block mb-5">Confirm Password <span class="text-red-400">*</span>
                    <input type="text" name="password_confirmation" id="password_confirmation" required value="{{old('password_confirmation')}}" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                </label>
                @error('password_confirmation')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
                <label for="id_number" class="block mb-5">Last 4 of Your SSN <span class="text-red-400">*</span>
                    <input type="text" name="id_number" id="id_number" required value="{{old('id_number')}}" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                </label>
                @error('id_number')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            <h2 class="text-contrastGold text-3xl text-center mb-4">Tell Us About Your Company</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                <label for="name" class="block mb-5">Company Name <span class="text-red-400">*</span>
                    <input type="text" name="name" id="name" required value="{{old('name')}}" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                </label>
                @error('name')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
                <label for="address" class="block mb-5">Address <span class="text-red-400">*</span>
                    <input type="text" name="address" id="address" required value="{{old('address')}}" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                </label>
                @error('address')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
                <label for="address2" class="block mb-5">Address 2
                    <input type="text" name="address2" id="address2" value="{{old('address2')}}" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                </label>
                <label for="city" class="block mb-5">City <span class="text-red-400">*</span>
                    <input type="text" name="city" id="city" required value="{{old('city')}}" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                </label>
                @error('city')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
                <label for="state" class="block mb-5">State <span class="text-red-400">*</span>
                    <select name="state" id="state" required class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                        <option value=""></option>
                        <option value="AL" {{ old('state') == 'AL' ? 'selected' : '' }}>Alabama</option>
                        <option value="AK" {{ old('state') == 'AK' ? 'selected' : '' }}>Alaska</option>
                        <option value="AZ" {{ old('state') == 'AZ' ? 'selected' : '' }}>Arizona</option>
                        <option value="AR" {{ old('state') == 'AR' ? 'selected' : '' }}>Arkansas</option>
                        <option value="CA" {{ old('state') == 'CA' ? 'selected' : '' }}>California</option>
                        <option value="CO" {{ old('state') == 'CO' ? 'selected' : '' }}>Colorado</option>
                        <option value="CT" {{ old('state') == 'CT' ? 'selected' : '' }}>Connecticut</option>
                        <option value="DE" {{ old('state') == 'DE' ? 'selected' : '' }}>Delaware</option>
                        <option value="DC" {{ old('state') == 'DC' ? 'selected' : '' }}>District Of Columbia</option>
                        <option value="FL" {{ old('state') == 'FL' ? 'selected' : '' }}>Florida</option>
                        <option value="GA" {{ old('state') == 'GA' ? 'selected' : '' }}>Georgia</option>
                        <option value="HI" {{ old('state') == 'HI' ? 'selected' : '' }}>Hawaii</option>
                        <option value="ID" {{ old('state') == 'ID' ? 'selected' : '' }}>Idaho</option>
                        <option value="IL" {{ old('state') == 'IL' ? 'selected' : '' }}>Illinois</option>
                        <option value="IN" {{ old('state') == 'IN' ? 'selected' : '' }}>Indiana</option>
                        <option value="IA" {{ old('state') == 'IA' ? 'selected' : '' }}>Iowa</option>
                        <option value="KS" {{ old('state') == 'KS' ? 'selected' : '' }}>Kansas</option>
                        <option value="KY" {{ old('state') == 'KY' ? 'selected' : '' }}>Kentucky</option>
                        <option value="LA" {{ old('state') == 'LA' ? 'selected' : '' }}>Louisiana</option>
                        <option value="ME" {{ old('state') == 'ME' ? 'selected' : '' }}>Maine</option>
                        <option value="MD" {{ old('state') == 'MD' ? 'selected' : '' }}>Maryland</option>
                        <option value="MA" {{ old('state') == 'MA' ? 'selected' : '' }}>Massachusetts</option>
                        <option value="MI" {{ old('state') == 'MI' ? 'selected' : '' }}>Michigan</option>
                        <option value="MN" {{ old('state') == 'MN' ? 'selected' : '' }}>Minnesota</option>
                        <option value="MS" {{ old('state') == 'MS' ? 'selected' : '' }}>Mississippi</option>
                        <option value="MO" {{ old('state') == 'MO' ? 'selected' : '' }}>Missouri</option>
                        <option value="MT" {{ old('state') == 'MT' ? 'selected' : '' }}>Montana</option>
                        <option value="NE" {{ old('state') == 'NE' ? 'selected' : '' }}>Nebraska</option>
                        <option value="NV" {{ old('state') == 'NV' ? 'selected' : '' }}>Nevada</option>
                        <option value="NH" {{ old('state') == 'NH' ? 'selected' : '' }}>New Hampshire</option>
                        <option value="NJ" {{ old('state') == 'NJ' ? 'selected' : '' }}>New Jersey</option>
                        <option value="NM" {{ old('state') == 'NM' ? 'selected' : '' }}>New Mexico</option>
                        <option value="NY" {{ old('state') == 'NY' ? 'selected' : '' }}>New York</option>
                        <option value="NC" {{ old('state') == 'NC' ? 'selected' : '' }}>North Carolina</option>
                        <option value="ND" {{ old('state') == 'ND' ? 'selected' : '' }}>North Dakota</option>
                        <option value="OH" {{ old('state') == 'OH' ? 'selected' : '' }}>Ohio</option>
                        <option value="OK" {{ old('state') == 'OK' ? 'selected' : '' }}>Oklahoma</option>
                        <option value="OR" {{ old('state') == 'OR' ? 'selected' : '' }}>Oregon</option>
                        <option value="PA" {{ old('state') == 'PA' ? 'selected' : '' }}>Pennsylvania</option>
                        <option value="RI" {{ old('state') == 'RI' ? 'selected' : '' }}>Rhode Island</option>
                        <option value="SC" {{ old('state') == 'SC' ? 'selected' : '' }}>South Carolina</option>
                        <option value="SD" {{ old('state') == 'SD' ? 'selected' : '' }}>South Dakota</option>
                        <option value="TN" {{ old('state') == 'TN' ? 'selected' : '' }}>Tennessee</option>
                        <option value="TX" {{ old('state') == 'TX' ? 'selected' : '' }}>Texas</option>
                        <option value="UT" {{ old('state') == 'UT' ? 'selected' : '' }}>Utah</option>
                        <option value="VT" {{ old('state') == 'VT' ? 'selected' : '' }}>Vermont</option>
                        <option value="VA" {{ old('state') == 'VA' ? 'selected' : '' }}>Virginia</option>
                        <option value="WA" {{ old('state') == 'WA' ? 'selected' : '' }}>Washington</option>
                        <option value="WV" {{ old('state') == 'WV' ? 'selected' : '' }}>West Virginia</option>
                        <option value="WI" {{ old('state') == 'WI' ? 'selected' : '' }}>Wisconsin</option>
                        <option value="WY" {{ old('state') == 'WY' ? 'selected' : '' }}>Wyoming</option>
                        <optgroup label="Territories">
                            <option value="AS" {{ old('state') == 'AS' ? 'selected' : '' }}>American Samoa</option>
                            <option value="GU" {{ old('state') == 'GU' ? 'selected' : '' }}>Guam</option>
                            <option value="MP" {{ old('state') == 'MP' ? 'selected' : '' }}>Northern Mariana Islands</option>
                            <option value="PR" {{ old('state') == 'PR' ? 'selected' : '' }}>Puerto Rico</option>
                            <option value="UM" {{ old('state') == 'UM' ? 'selected' : '' }}>United States Minor Outlying Islands</option>
                            <option value="VI" {{ old('state') == 'VI' ? 'selected' : '' }}>Virgin Islands</option>
                        </optgroup>
                    </select>
                </label>
                @error('state')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
                <label for="zip" class="block mb-5">Zip <span class="text-red-400">*</span>
                    <input type="text" name="zip" id="zip" required value="{{old('zip')}}" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                </label>
                @error('zip')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
                <label for="website" class="block mb-5">Website
                    <input type="text" name="website" id="website" required value="{{old('website')}}" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                </label>
                @error('website')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
                <label for="company_phone" class="block mb-5">Phone
                    <input type="text" name="company_phone" id="company_phone" required value="{{ old('company_phone') }}" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                </label>
                <label for="company_phone2" class="block mb-5">Alt Phone
                    <input type="text" name="company_phone2" id="company_phone2" value="{{ old('company_phone2') }}" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                </label>
                <label for="toll_free" class="block mb-5">Toll-free
                    <input type="text" name="toll_free" id="toll_free" value="{{old('toll_free')}}" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                </label>
                <label for="logo" class="block mb-5">Company Logo <span class="text-red-400">*</span>
                    <input type="file" name="logo" id="logo" required class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                </label>
                @error('logo')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            <h2 class="text-contrastGold text-3xl text-center mb-4">Payment Information</h2>
            <p>This card will be used to pay your monthly subscription to the service.  Reservation amounts and fees will not be posted to this card.</p>
            <label for="number" class="block mb-5">Credit Card Number <span class="text-red-400">*</span>
                <input type="text" name="number" id="number" required value="{{ old('number') }}" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
            </label>
            @error('number')
                <span class="text-red-400">{{ $message }}</span>
            @enderror
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <label for="exp_year" class="block mb-5">Exp Year <span class="text-red-400">*</span>
                    <select name="exp_year" id="exp_year" required class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                        <option value=""></option>
                        @for ($i = date('Y'); $i < date('Y') + 10; $i++)
                            <option {{ old('exp_year') == $i ? 'selected' : '' }}>{{$i}}</option>
                        @endfor
                    </select>
                    @error('exp_year')
                        <span class="text-red-400">{{ $message }}</span>
                    @enderror
                </label>
                <label for="exp_month" class="block mb-5">Exp Month <span class="text-red-400">*</span>
                    <select name="exp_month" id="exp_month" required class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                        <option value=""></option>
                        @for ($i = 1; $i <= 12; $i++)
                            <option {{ old('exp_month') == $i ? 'selected' : '' }}>{{$i}}</option>
                        @endfor
                    </select>
                    @error('exp_month')
                        <span class="text-red-400">{{ $message }}</span>
                    @enderror
                </label>
                <label for="cvc" class="block mb-5">CVC Number <span class="text-red-400">*</span>
                    <input type="text" name="cvc" id="cvc" value="{{old('cvc')}}" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                    @error('cvc')
                        <span class="text-red-400">{{ $message }}</span>
                    @enderror
                </label>
            </div>
            <h2 class="text-contrastGold text-3xl text-center mb-4">Banking Information</h2>
            <p>We use this information to deposit your reservations and fees.</p>
            <label for="account_holder" class="block mb-5">Account Holder Name
                <input type="text" name="account_holder" id="account_holder" required value="{{old('account_holder')}}" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
            </label>
            @error('account_holder')
                    <span class="text-red-400">{{ $message }}</span>
            @enderror
            <label for="account_number" class="block mb-5">Bank Account Number <span class="text-red-400">*</span>
                <input type="text" required name="account_number" id="account_number" required value="{{old('account_number')}}" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
            </label>
            @error('account_number')
                <span class="text-red-400">{{ $message }}</span>
            @enderror
            <label for="routing_number" class="block mb-5">Routing Number <span class="text-red-400">*</span>
                <input type="text" required name="routing_number" id="routing_number" required value="{{old('routing_number')}}" class="shadow appearance-none border border-[#ccc] mb-2 rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
            </label>
            @error('routing_number')
                <span class="text-red-400">{{ $message }}</span>
            @enderror
            <label for="accepted_terms" class="block mb-5">
                <input type="checkbox" value="1" required name="accepted_terms" id="accepted_terms" class="shadow appearance-none border border-[#ccc] bg-white mb-2 rounded p-2 leading-tight focus:outline-none focus:shadow-outline">
                <span class="text-red-400">*</span> Click here to accept the <a href="{{ route('tos') }}" target="_blank" class="underline text-blue-400">Terms of Service</a> for Morph Digital.
            </label>
            <label for="acknowledged_legality" class="block mb-5">
                <input type="checkbox" value="1" required name="acknowledged_legality" id="acknowledged_legality" class="shadow appearance-none border border-[#ccc] bg-white mb-2 rounded p-2 leading-tight focus:outline-none focus:shadow-outline">
                <span class="text-red-400">*</span> Click here to certify that you are legally able to use this service as required by local, state, and other applicable law, and that all information provided is true and accurate.
            </label>
            <input type="submit" value="Let's Go!" class="nav bg-gold hover:bg-darkGold text-black hover:text-white py-3 px-4 decoration-0 flex-nowrap">
        </form>
    </section>

    {{-- <script src="https://js.stripe.com/v3/"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <script>
        jQuery(function(){
            var stripe = Stripe('{{ env('STRIPE_KEY') }}');
            var elements = stripe.elements();

            var style = {
                base: {
                    // Add your base input styles here. For example:
                    fontSize: '16px',
                    color: "#32325d",
                }
            };
            var card = elements.create('card', {style: style});
            card.mount('#card-element');

            card.addEventListener('change', function(event) {
              var displayError = document.getElementById('card-errors');
              if (event.error) {
                displayError.textContent = event.error.message;
              } else {
                displayError.textContent = '';
              }
            });

            var form = document.getElementById('payment-form');
            form.addEventListener('submit', function(event) {
              event.preventDefault();

              stripe.createToken(card).then(function(result) {
                if (result.error) {
                  // Inform the customer that there was an error.
                  var errorElement = document.getElementById('card-errors');
                  errorElement.textContent = result.error.message;
                } else {
                  // Send the token to your server.
                  stripeTokenHandler(result.token);
                }
              });
            });

            function stripeTokenHandler(token) {
              // Insert the token ID into the form so it gets submitted to the server
              var form = document.getElementById('payment-form');
              var hiddenInput = document.createElement('input');
              hiddenInput.setAttribute('type', 'hidden');
              hiddenInput.setAttribute('name', 'stripeToken');
              hiddenInput.setAttribute('value', token.id);
              form.appendChild(hiddenInput);

              // Submit the form
              form.submit();
            }
        })
    </script> --}}
    
</x-guest-layout>
