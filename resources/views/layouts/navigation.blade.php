<nav x-data="{ open: false }" class="sticky top-3 z-40 mx-3 sm:mx-6 mt-3 rounded-2xl bg-white/50 dark:bg-gray-900/40 backdrop-blur-2xl border border-white/60 dark:border-white/10 shadow-lg shadow-black/5">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5">
                        <x-application-logo class="block h-9 w-9 fill-current text-amber-600 dark:text-amber-400" />
                        <span class="hidden md:block leading-tight">
                            <span class="block font-serif text-base font-semibold tracking-wide text-stone-800 dark:text-gray-100">HOTEL</span>
                            <span class="block text-[9px] tracking-[0.25em] text-amber-600 dark:text-amber-400">MANAGEMENT SYSTEM</span>
                        </span>
                    </a>
                </div>

                <div class="hidden space-x-2 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('room-types.index')" :active="request()->routeIs('room-types.*')">
                        {{ __('Room Types') }}
                    </x-nav-link>
                    <x-nav-link :href="route('rooms.index')" :active="request()->routeIs('rooms.*')">
                        {{ __('Rooms') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6 gap-3">

                {{-- Dark/Light Toggle --}}
                <button onclick="toggleDarkMode()" type="button"
                        class="p-2 rounded-full text-gray-500 dark:text-gray-300 hover:bg-white/50 dark:hover:bg-white/10">
                    <svg id="icon-sun" class="w-5 h-5 hidden dark:block" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    <svg id="icon-moon" class="w-5 h-5 block dark:hidden" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                    </svg>
                </button>

                {{-- Language Switcher --}}
                <div class="flex items-center border border-white/60 dark:border-white/15 bg-white/40 dark:bg-white/10 rounded-full overflow-hidden text-xs font-semibold">
                    <a href="{{ route('locale.switch', 'en') }}"
                       class="px-2.5 py-1 {{ app()->getLocale() === 'en' ? 'bg-amber-600 text-white' : 'text-gray-500 dark:text-gray-300 hover:bg-white/50 dark:hover:bg-white/10' }}">EN</a>
                    <a href="{{ route('locale.switch', 'km') }}"
                       class="px-2.5 py-1 {{ app()->getLocale() === 'km' ? 'bg-amber-600 text-white' : 'text-gray-500 dark:text-gray-300 hover:bg-white/50 dark:hover:bg-white/10' }}">ខ្មែរ</a>
                </div>

                <div class="relative ms-3">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center gap-2 px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-full text-gray-600 dark:text-gray-300 bg-transparent hover:bg-white/50 dark:hover:bg-white/10 hover:text-gray-800 dark:hover:text-white focus:outline-none transition ease-in-out duration-150">
                                <img src="{{ Auth::user()->profilePhotoUrl() }}" class="w-8 h-8 rounded-full object-cover border border-amber-300" alt="{{ Auth::user()->name }}">
                                {{ Auth::user()->name }}
                                <svg class="ms-1 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <div class="-me-2 flex items-center sm:hidden gap-2">
                <button onclick="toggleDarkMode()" type="button" class="p-2 rounded-full text-gray-500 dark:text-gray-300">
                    <svg class="w-5 h-5 hidden dark:block" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    <svg class="w-5 h-5 block dark:hidden" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                </button>

                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 dark:hover:text-gray-300 hover:bg-white/50 dark:hover:bg-white/10 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('room-types.index')" :active="request()->routeIs('room-types.*')">
                {{ __('Room Types') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('rooms.index')" :active="request()->routeIs('rooms.*')">
                {{ __('Rooms') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-700">
            <div class="flex items-center px-4 gap-3">
                <img src="{{ Auth::user()->profilePhotoUrl() }}" class="w-10 h-10 rounded-full object-cover border border-amber-300">
                <div>
                    <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 px-4 flex gap-2">
                <a href="{{ route('locale.switch', 'en') }}" class="px-3 py-1 text-xs rounded-full {{ app()->getLocale() === 'en' ? 'bg-amber-600 text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300' }}">EN</a>
                <a href="{{ route('locale.switch', 'km') }}" class="px-3 py-1 text-xs rounded-full {{ app()->getLocale() === 'km' ? 'bg-amber-600 text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300' }}">ខ្មែរ</a>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>

<script>
    function toggleDarkMode() {
        document.documentElement.classList.toggle('dark');
        localStorage.theme = document.documentElement.classList.contains('dark') ? 'dark' : 'light';
    }
</script>