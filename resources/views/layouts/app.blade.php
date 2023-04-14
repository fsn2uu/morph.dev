<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <title>Document</title>
    </head>
    <body class="bg-[#f2f2f2]" id="app">
        <header class="bg-charcoal">
            <x-admin-nav></x-admin-nav>
        </header>
        {{ $slot }}
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
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
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
    <script src="{{ mix('js/vue.js') }}" defer></script>
</html>