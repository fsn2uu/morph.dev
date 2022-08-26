<nav class="relative container mx-auto p-6 bg-charcoal">
    <div class="flex items-center justify-between">
        <div class="p-2">
            <a href="{{ route('welcome') }}">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                <span class="text-2xl ml-2 text-white">Morph</span>
            </a>
        </div>
        <div class="hidden md:flex space-x-6 items-baseline text-white">
            <a href="{{ route('plans') }}" class="nav">Plans</a>
            <a href="{{ route('features') }}" class="nav">Features</a>
            <a href="{{ route('faq') }}" class="nav">FAQ</a>
            <a href="{{ route('about') }}" class="nav">About</a>
            <a href="{{ route('contact') }}" class="nav">Contact</a>
            <a href="{{ route('signup') }}" class="nav bg-gold hover:bg-darkGold text-black hover:text-white py-3 px-4 ml-7 decoration-0">Get Started</a>
            <a href="{{ route('admin.dashboard') }}" class="nav bg-gray-200 hover:bg-gold text-black hover:text-white py-3 px-4 ml-7 decoration-0">Sign In</a>
        </div>
        <button id="menu-btn" class="block hamburger md:hidden focus:outline-none">
            <span class="hamburger-top bg-gold"></span>
            <span class="hamburger-middle bg-gold"></span>
            <span class="hamburger-bottom bg-gold"></span>
        </button>
    </div>
    
    <!-- Mobile Menu -->
    <div class="md:hidden z-30">
        <div id="menu" class="absolute flex-col items-center hidden self-end py-8 mt-10 space-y-6 font-bold bg-white sm:w-auto sm:self-center left-6 right-6 drop-shadow-md z-30">
            <a href="{{ route('plans') }}" class="nav">Plans</a>
            <a href="{{ route('features') }}" class="nav">Features</a>
            <a href="{{ route('faq') }}" class="nav">FAQ</a>
            <a href="{{ route('about') }}" class="nav">About</a>
            <a href="{{ route('contact') }}" class="nav">Contact</a>
            <hr>
            <a href="{{ route('signup') }}" class="nav">Get Started</a>
            <a href="{{ route('admin.dashboard') }}" class="nav">Sign In</a>
        </div>
    </div>
</nav>