<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <title>Document</title>
        @stack('head')
    </head>
    <body class="bg-[#f2f2f2]" id="app">
        <header class="bg-charcoal">
            @if (Request::segment(1) == 'admin')
                <x-admin-nav></x-admin-nav>
            @else
                <x-navigation></x-navigation>
            @endif
        </header>
        @if (Session::has('expired'))
            {{ Session::get('expired') }}
        @endif
        @yield('content')
        <footer class="bg-charcoal text-white px-20 py-10">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="md:order-1 text-center md:text-left">
                    <p><a href="{{ route('welcome') }}" class="underline">Home</a></p>
                    <p><a href="{{ route('plans') }}" class="underline">Plans</a></p>
                    <p><a href="{{ route('features') }}" class="underline">Features</a></p>
                    <p><a href="{{ route('faq') }}" class="underline">FAQ</a></p>
                    <p><a href="{{ route('about') }}" class="underline">About Us</a></p>
                    <p><a href="{{ route('contact') }}" class="underline">Contact Us</a></p>
                </div>
                <div class="md:order-3 text-center md:text-right">
                    <svg id="logo-68" width="70" height="70" viewBox="0 0 50 50" class="inline" fill="none" xmlns="http://www.w3.org/2000/svg"><path class="stroke fill-gold" d="M48.9 33H16.4V0.469971H26.62C32.529 0.469971 38.1961 2.81732 42.3744 6.99563C46.5527 11.1739 48.9 16.8409 48.9 22.75V33Z" stroke="black" stroke-width="0.43" stroke-miterlimit="10"></path><path class="stroke" d="M46.26 34.5799H14.86V3.16992H25C27.7914 3.16861 30.5558 3.71729 33.1351 4.78461C35.7144 5.85194 38.0582 7.41699 40.0325 9.39037C42.0068 11.3637 43.5729 13.7068 44.6415 16.2856C45.71 18.8644 46.26 21.6285 46.26 24.4199V34.5799Z" stroke="black" stroke-width="0.43" stroke-miterlimit="10"></path><path class="stroke" d="M43.62 36.1801H13.32V5.87012H23.4C26.0553 5.87012 28.6847 6.39312 31.1379 7.40927C33.5911 8.42542 35.8201 9.91482 37.6977 11.7924C39.5753 13.67 41.0647 15.8991 42.0809 18.3523C43.097 20.8055 43.62 23.4348 43.62 26.0901V36.1801Z" stroke="black" stroke-width="0.44" stroke-miterlimit="10"></path><path class="stroke" d="M41 37.7801H11.78V8.57008H21.78C24.3031 8.56745 26.8019 9.06213 29.1337 10.0258C31.4655 10.9896 33.5844 12.4034 35.3694 14.1866C37.1544 15.9697 38.5705 18.0872 39.5366 20.4179C40.5027 22.7487 41 25.247 41 27.7701V37.7801Z" stroke="black" stroke-width="0.45" stroke-miterlimit="10"></path><path class="stroke" d="M38.35 39.38H10.24V11.27H20.18C24.9982 11.2727 29.6182 13.1879 33.0252 16.5948C36.4322 20.0018 38.3473 24.6218 38.35 29.44V39.38Z" stroke="black" stroke-width="0.46" stroke-miterlimit="10"></path><path class="stroke" d="M35.71 41H8.70001V14H18.57C23.1106 14 27.4657 15.8017 30.6792 19.0096C33.8927 22.2175 35.7021 26.5694 35.71 31.11V41Z" stroke="black" stroke-width="0.46" stroke-miterlimit="10"></path><path class="stroke" d="M33.07 42.5899H7.15997V16.6699H17C21.2666 16.6832 25.3539 18.3873 28.3662 21.409C31.3785 24.4307 33.07 28.5233 33.07 32.7899V42.5899Z" stroke="black" stroke-width="0.47" stroke-miterlimit="10"></path><path class="stroke" d="M30.44 44.1901H5.62V19.3701H15.35C19.3513 19.3728 23.188 20.9635 26.0173 23.7928C28.8467 26.6222 30.4373 30.4588 30.44 34.4601V44.1901Z" stroke="black" stroke-width="0.48" stroke-miterlimit="10"></path><path class="stroke" d="M27.8 45.7901H4.08002V22.0701H13.74C17.4699 22.0727 21.0461 23.5563 23.6825 26.1946C26.319 28.833 27.8 32.4102 27.8 36.1401V45.7901Z" stroke="black" stroke-width="0.49" stroke-miterlimit="10"></path><path class="stroke" d="M25.16 47.4H2.53998V24.77H12.13C13.8372 24.77 15.5276 25.1063 17.1049 25.7596C18.6821 26.4129 20.1152 27.3705 21.3224 28.5776C22.5295 29.7848 23.4871 31.2179 24.1404 32.7951C24.7937 34.3724 25.13 36.0628 25.13 37.77L25.16 47.4Z" stroke="black" stroke-width="0.49" stroke-miterlimit="10"></path><path class="stroke" d="M22.53 49H1V27.47H10.52C13.7026 27.47 16.7548 28.7343 19.0053 30.9847C21.2557 33.2351 22.52 36.2874 22.52 39.47L22.53 49Z" stroke="black" stroke-width="0.5" stroke-miterlimit="10"></path></svg>
                    <p>Morph Digital, LLC</p>
                    <p>[ADDRESS HERE]</p>
                    <p>[ADDRESS HERE]</p>
                    <p>[PHONE HERE]</p>
                    <p><a href="{{ route('contact') }}" class="underline">Contact Us</a></p>
                </div>
                <div class="md:order-2">
                    <p class="text-sm text-center">&copy; {{ \Carbon\Carbon::now()->format('Y') }} Morph Digital, LLC</p>
                </div>
            </div>
        </footer>
        {{-- <p class="text-5xl text-white">Some text will go here</p>
        <img src="{{ asset('assets/pexels-ruslan-konev-7011768.jpeg') }}" alt="" class="inline float-right -z-1 w-2/3"> --}}
    </body>
    <script src="{{ mix('js/app.js') }}" defer></script>
    @stack('scripts')
</html>