<nav class="relative container mx-auto p-6 bg-charcoal">
    <div class="flex items-center justify-between">
        <div class="p-2">
            <a href="{{ route('admin.dashboard') }}">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                <span class="text-2xl ml-2 text-white">Morph</span>
            </a>
        </div>
        <div class="hidden md:flex space-x-6 items-baseline text-white">
            <a href="{{ route('admin.neighborhoods.index') }}" class="nav">Neighborhoods</a>
            <a href="{{ route('admin.units.index') }}" class="nav">Units</a>
            <a href="{{ route('admin.reservations.index') }}" class="nav">Reservations</a>
            <a href="{{ route('admin.travelers.index') }}" class="nav">Travelers</a>
            <a href="#" class="nav">Specials</a>
            <a href="#" class="nav">Tasks</a>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center hover:border-gray-300 focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                            <div>
                                <img src="{{ Gravatar::get(Auth::user()->email) }}" class="rounded-full h-8 mr-2 inline" alt="{{ Auth::user()->fname }}  {{ Auth::user()->lname }}">
                                {{ Auth::user()->fname }}
                            </div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link>{{ __('Website Settings') }}</x-dropdown-link>
                        <x-dropdown-link :href="route('admin.settings.company')">{{ __('Company Settings') }}</x-dropdown-link>
                        <x-dropdown-link :href="route('admin.users.edit', Auth::user())">{{ __('My Profile') }}</x-dropdown-link>
                        <x-dropdown-link :href="route('admin.users.index')">{{ __('Users') }}</x-dropdown-link>
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
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
            <a href="{{ route('admin.neighborhoods.index') }}">Neighborhoods</a>
            <a href="{{ route('admin.units.index') }}">Units</a>
            <a href="{{ route('admin.reservations.index') }}">Reservations</a>
            <a href="{{ route('admin.travelers.index') }}">Travelers</a>
            <a href="#">Specials</a>
            <a href="#">Tasks</a>
            <a href="{{ route('admin.users.index') }}">Users</a>
            <div class="sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center hover:border-gray-300 focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                            <div>
                                <img src="{{ Gravatar::get(Auth::user()->email) }}" class="rounded-full h-8 mr-2 inline" alt="{{ Auth::user()->fname }}  {{ Auth::user()->lname }}">
                                {{ Auth::user()->fname }}
                            </div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link>{{ __('Website Settings') }}</x-dropdown-link>
                        <x-dropdown-link :href="route('admin.settings.company')">{{ __('Company Settings') }}</x-dropdown-link>
                        <x-dropdown-link :href="route('admin.users.edit', Auth::user())">{{ __('My Profile') }}</x-dropdown-link>
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>