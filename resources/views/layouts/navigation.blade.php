<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 fixed right-0 left-0">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-14">
        <div class="flex h-16">
            @if (Route::has('login'))
            @auth
            <div class="flex items-center justify-between w-full">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a class="flex items-center gap-2" href="{{ route('home') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                        <span>Karabo</span>
                    </a>
                </div>


                <!-- Navigation Links -->
                <div class="flex gap-10 items-center">
                    <a href="{{route('home')}}">
                        <img width="25px" src="{{asset('assets/img/home.svg')}}" alt="">
                    </a>
                    <a href="">
                        <img width="25px" src="{{asset('assets/img/jawab.svg')}}" alt="">
                    </a>
                    <a href="{{route('kategoris')}}">
                        <img width="25px" src="{{asset('assets/img/kategori.svg')}}" alt="">
                    </a>
                </div>

                <!-- Search Bar -->
                <div class="relative w-[40%]">
                    <input class="w-full rounded-xl pl-10" type="text" placeholder="Cari Pertanyaan">
                    <button class="absolute left-3 top-3"><img class="w-4" src="{{asset('assets/img/search.svg')}}" alt=""></button>
                </div>

                {{-- Profil --}}
                <div class="flex items-center gap-5">
                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="flex items-center border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                    <div>
                                        @if(auth()->user()->profile_image)
                                        <img class="w-11 h-11 rounded-full border-[1px] border-black object-cover" src="{{ asset('storage/' . auth()->user()->profile_image) }}" alt="Profil">
                                        @else
                                        <img class="w-11 h-11 rounded-full border-2 border-white object-cover" src="{{ asset('assets/img/default-profile.png') }}" alt="Profile">
                                    </div>
                                    @endif
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                @if(auth()->user()->hasRole('admin'))
                                <x-dropdown-link :href="('/dashboard-admin')">
                                    {{ __('Dashboard') }}
                                </x-dropdown-link>
                                @endif

                                @if(auth()->user()->hasRole('pengguna'))
                                <x-dropdown-link :href="('/dashboard')">
                                    {{ __('Dashboard') }}
                                </x-dropdown-link>
                                @endif

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                    <a href="{{route('post.create')}}" class="flex items-center border-[1px] border-black p-1.5 rounded-lg gap-1">
                        <img width="23px" src="{{asset('assets/img/tambah.svg')}}" alt="">
                        <span class="text-sm">Tambah Pertanyaan</span>
                    </a>
                </div>
            </div>


            <!-- Settings Dropdown -->


            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @if(auth()->user()->hasRole('admin'))
            <x-responsive-nav-link :href="route('dashboard.admin')" :active="request()->routeIs('dashboard.admin')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            @endif

            @if(auth()->user()->hasRole('pengguna'))
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Jak') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>

    @else
    <div class="sm:fixed sm:top-0 sm:right-0 flex justify-between items-center p-6 text-right z-10 w-full h-16 bg-white border-b border-gray-100">
        <div class="flex items-center w-[87%] justify-between">
            <a class="flex items-center" href="{{ route('home') }}">
                <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                <span>Karabo</span>
            </a>

            <div class="flex gap-10 items-center">
                <a href="{{route('home')}}">
                    <img width="25px" src="{{asset('assets/img/home.svg')}}" alt="">
                </a>
                <a href="">
                    <img width="25px" src="{{asset('assets/img/jawab.svg')}}" alt="">
                </a>
                <a href="{{route('kategoris')}}">
                    <img width="25px" src="{{asset('assets/img/kategori.svg')}}" alt="">
                </a>
            </div>

            <!-- Search Bar -->
            <div class="relative w-[40%]">
                <input class="w-full rounded-xl pl-10" type="text" placeholder="Cari Pertanyaan">
                <button class="absolute left-3 top-3"><img class="w-4" src="{{asset('assets/img/search.svg')}}" alt=""></button>
            </div>

            <a href="{{route('post.create')}}" class="flex items-center border-[1px] border-black p-1.5 rounded-lg gap-1">
                <img width="23px" src="{{asset('assets/img/tambah.svg')}}" alt="">
                <span class="text-sm">Tambah Pertanyaan</span>
            </a>
        </div>
        <div class="flex items-center">
            <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-slate-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-slate-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
        </div>
    </div>
    @endif
    @endauth
    @endif
</nav>
