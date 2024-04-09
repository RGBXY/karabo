<nav x-data="{ open: false }" class="bg-white border-b-[1px] border-slate-200 fixed right-0 left-0 z-40">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-14">
        <div class="flex h-16">

            <div class="flex items-center justify-between w-full">
                <!-- Logo -->
                <div class="flex items-center">
                    <a class="flex items-center gap-2" href="{{ route('home') }}">
                        <x-application-logo class="block w-28 h-2w-28 fill-current text-gray-800" />
                    </a>
                </div>


                <!-- Navigation Links -->
                <div class="flex gap-10 items-center">
                    <a href="{{route('home')}}">
                        <img width="25px" src="{{asset('assets/img/home.svg')}}" alt="">
                    </a>
                    <a href="{{route('jawab')}}">
                        <img width="25px" src="{{asset('assets/img/jawab.svg')}}" alt="">
                    </a>
                    <a href="{{route('kategoris')}}">
                        <img width="25px" src="{{asset('assets/img/kategori.svg')}}" alt="">
                    </a>
                </div>

                <!-- Search Bar -->
                <form action="/" class="w-[30%]">
                    @if(request('kategori'))
                    <input type="hidden" name="kategori" value="{{request('kategori')}}">
                    @endif
                    <div class="relative w-[100%]">
                        <input class="w-full rounded-3xl pl-6 py-2.5 border-none focus:ring-0 text-sm bg-slate-100" type="text" placeholder="Cari Pertanyaan" name="search" value="{{request('search')}}">
                        <button type="submit" class="absolute right-0 bg-slate-200 h-full w-14 rounded-e-3xl"><img class="w-5 mx-auto" src="{{asset('assets/img/search.svg')}}" alt=""></button>
                    </div>
                </form>

                @if (Route::has('login'))
                @auth
                {{-- Profil --}}
                <div class="flex items-center gap-5">
                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="flex items-center border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                    <div>
                                        @if(auth()->user()->profile_image)
                                        <img class="w-10 h-10 rounded-full object-cover border-[1px] border-slate-200" src="{{ asset('storage/' . auth()->user()->profile_image) }}" alt="Profil">
                                        @else
                                        <img class="w-10 h-10 rounded-full object-cover" src="{{ asset('assets/img/default-profile.png') }}" alt="Profile">
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
                                <x-dropdown-link :href="('/dashboard/pertanyaan')">
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
                    <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" type="button" class="hover:bg-slate-300 transition-all py-1.5 px-2 rounded-3xl">
                        <span class="text-sm">Tambah Pertanyaan</span>
                    </button>
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

    <div class="flex items-center gap-8">
        <div>
            <a href="{{ route('login') }}" class="font-semibold text-black hover:text-gray-600 dark:text-gray-400 dark:hover:text-slate-900  transition-all">Log in</a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}" class="ml-4 font-semibold text-black hover:text-gray-600 dark:text-gray-400 dark:hover:text-slate-900  transition-all">Register</a>
        </div>
        <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" type="button" class="hover:bg-slate-300 transition-all py-1.5 px-2 rounded-3xl">
            <span class="text-sm">Tambah Pertanyaan</span>
        </button>
    </div>
    </div>
    @endif
    @endauth
    @endif
</nav>
