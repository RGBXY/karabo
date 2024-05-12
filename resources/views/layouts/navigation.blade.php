<nav x-data="{ open: false }" class="bg-white border-b-[1px] border-slate-200 fixed right-0 left-0 z-40">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-14">
        <div class="flex justify-center h-16">

            <div class="flex items-center justify-between w-full">

                <div class="flex items-center gap-2 justify-start w-auto">
                    <!-- Hamburger -->
                    <div class=" lg:hidden">
                        <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Logo -->
                    <div class="">
                        <a class="" href="{{ route('home') }}">
                            <x-application-logo class="block w-20 lg:w-28 fill-current text-gray-800" />
                        </a>
                    </div>
                </div>

                <!-- Navigation Links -->
                <div class="lg:flex gap-10 items-center h-full hidden">
                    <a class="h-full" href="{{route('home')}}">
                        <div class="px-3 flex items-center relative h-full">
                            <img class="w-7" src="{{asset('assets/img/home.svg')}}" alt="">
                            <div class="{{ Request::is('/*') ? ' border-b-[3px] border-black  ' : '' }}absolute right-0 bottom-0 rounded-t-xl w-full"></div>
                        </div>
                    </a>
                    <a class="h-full" href="{{route('jawab')}}">
                        <div class="px-3 flex items-center relative h-full">
                            <img class="w-7" src="{{asset('assets/img/jawab.svg')}}" alt="">
                            <div class="{{ Request::is('jawab*') ? ' border-b-[3px] border-black  ' : '' }}absolute right-0 bottom-0 rounded-t-xl w-full"></div>
                        </div>
                    </a>
                    <a class="h-full" href="{{route('kategoris')}}">
                        <div class="px-3 flex items-center relative h-full">
                            <img class="w-7" src="{{asset('assets/img/kategori.svg')}}" alt="">
                            <div class="{{ Request::is('kategori*') ? ' border-b-[3px] border-black  ' : '' }}absolute right-0 bottom-0 rounded-t-xl w-full"></div>
                        </div>
                    </a>
                </div>

                <!-- Search Bar -->
                <form action="/" class="md:w-[40%] lg:w-[30%] hidden md:block">
                    @if(request('kategori'))
                    <input type="hidden" name="kategori" value="{{request('kategori')}}">
                    @endif
                    <div class="relative w-[100%]">
                        <input class="w-full rounded-3xl pl-6 py-2.5 border-none focus:ring-0 text-sm bg-slate-100" type="text" placeholder="Cari Pertanyaan" name="search" value="{{request('search')}}">
                        <button type="submit" class="absolute right-0 bg-slate-200 h-full w-14 rounded-e-3xl"><img class="w-5 mx-auto" src="{{asset('assets/img/search.svg')}}" alt=""></button>
                    </div>
                </form>

                {{-- Profil --}}
                <div class="flex items-center gap-5">

                    <button class="md:hidden" onclick="toggleComponent()">
                        <img id="searchToggle" class="w-6" src="{{asset('assets/img/search.svg')}}" alt="">
                    </button>

                    @if (Route::has('login'))
                    @auth

                    <div class="">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="flex items-center border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                    <div>
                                        @if(auth()->user()->profile_image)
                                        <img class="w-8 h-8 lg:w-10 lg:h-10 rounded-full object-cover border-[1px] border-slate-200" src="{{ asset('storage/' . auth()->user()->profile_image) }}" alt="Profil">
                                        @else
                                        <img class="w-8 h-8 lg:w-10 lg:h-10 rounded-full object-cover" src="{{ asset('assets/img/default-profile.png') }}" alt="Profile">
                                        @endif
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                @if(auth()->user()->hasRole('admin'))
                                <x-dropdown-link :href="('/dashboard/admin')">
                                    {{ __('Dashboard') }}
                                </x-dropdown-link>
                                @endif

                                @if(auth()->user()->hasRole('pengguna'))
                                <x-dropdown-link :href="('/dashboard/pertanyaan')">
                                    {{ __('Dashboard') }}
                                </x-dropdown-link>
                                @endif

                                <x-dropdown-link class="md:hidden">
                                    <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" type="button">
                                        <span class="text-sm">Tambah Pertanyaan</span>
                                    </button>
                                </x-dropdown-link>

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

                    @else

                    <div class="hidden md:block">
                        <a href="{{ route('login') }}" class="font-semibold text-black hover:text-gray-600 dark:text-gray-400 dark:hover:text-slate-900  transition-all">Masuk</a>

                        @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 font-semibold text-black hover:text-gray-600 dark:text-gray-400 dark:hover:text-slate-900  transition-all">Daftar</a>
                        @endif
                    </div>

                    @endif
                    @endauth

                    {{-- <a href="{{route('post.create')}}" data-modal-target="crud-modal" data-modal-toggle="crud-modal" type="button" class="hidden md:block hover:bg-slate-300 transition-all py-1.5 px-2 rounded-3xl">
                    <span class="text-sm">Tambah Pertanyaan</span>
                    </a> --}}

                    <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" type="button" class="hidden md:block hover:bg-slate-300 transition-all py-1.5 px-2 rounded-3xl">
                        <span class="text-sm">Tambah Pertanyaan</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden lg:hidden">
        <div class="pt-2 pb-3 space-y-1">

            @if(Route::has('login'))
            @auth
            <x-responsive-nav-link :href="route('home')">
                <div class="flex items-center gap-2">
                    <img class="w-5" src="{{asset('assets/img/home.svg')}}" alt="">
                    <p class="font-bold">Home</p>
                </div>
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('jawab')">
                <div class="flex items-center gap-2">
                    <img class="w-5" src="{{asset('assets/img/jawab.svg')}}" alt="">
                    <p class="font-bold">Jawab</p>
                </div>
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('kategoris')">
                <div class="flex items-center gap-2">
                    <img class="w-5" src="{{asset('assets/img/kategori.svg')}}" alt="">
                    <p class="font-bold">Topik</p>
                </div>
            </x-responsive-nav-link>

            @else

            <x-responsive-nav-link :href="route('home')">
                <div class="flex items-center gap-2">
                    <img class="w-5" src="{{asset('assets/img/home.svg')}}" alt="">
                    <p class="font-bold">Home</p>
                </div>
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('jawab')">
                <div class="flex items-center gap-2">
                    <img class="w-5" src="{{asset('assets/img/jawab.svg')}}" alt="">
                    <p class="font-bold">Jawab</p>
                </div>
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('kategoris')">
                <div class="flex items-center gap-2">
                    <img class="w-5" src="{{asset('assets/img/kategori.svg')}}" alt="">
                    <p class="font-bold">Topik</p>
                </div>
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('login')">
                <div class="flex items-center gap-2">
                    <img class="w-5" src="{{asset('assets/img/log-in.svg')}}" alt="">
                    <p class="font-bold">Masuk</p>
                </div>
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('register')">
                <div class="flex items-center gap-2">
                    <img class="w-5" src="{{asset('assets/img/user-plus.svg')}}" alt="">
                    <p class="font-bold">Daftar</p>
                </div>
            </x-responsive-nav-link>

            @endauth
            @endif
        </div>
    </div>

    <div id="searchBar" class="px-5 pb-3 md:hiddn" style="display: none">
        <form action="/" class="md:w-[40%] lg:w-[30%] md:block">
            @if(request('kategori'))
            <input type="hidden" name="kategori" value="{{request('kategori')}}">
            @endif
            <div class="relative w-[100%] md:hidden">
                <input class="w-full rounded-3xl pl-6 py-2.5 border-none focus:ring-0 text-sm bg-slate-100" type="text" placeholder="Cari Pertanyaan" name="search" value="{{request('search')}}">
                <button type="submit" class="absolute right-0 bg-slate-200 h-full w-14 rounded-e-3xl"><img class="w-5 mx-auto" src="{{asset('assets/img/search.svg')}}" alt=""></button>
            </div>
        </form>
    </div>
</nav>

<script>
    function toggleComponent() {
        const component = document.getElementById('searchBar');
        const statusIcon = document.getElementById('searchToggle');
        if (component.style.display === 'none') {
            component.style.display = 'block';
            statusIcon.src = "{{ asset('assets/img/x.svg') }}";
            statusIcon.alt = "Tutup";
        } else {
            component.style.display = 'none';
            statusIcon.src = "{{ asset('assets/img/search.svg') }}";
            statusIcon.alt = "Buka";
        }
    }

</script>
