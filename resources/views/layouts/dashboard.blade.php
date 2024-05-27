<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>

    <style>
        .ck-editor__editable_inline {
            min-height: 200px;
        }

    </style>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen">
        <!-- Page Heading -->
        @if (isset($header))
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endif

        <!-- Page Content -->
        <div class="h-full ">
            <div class="w-full bg-[#efeff0] border-b border-black h-20 fixed flex justify-between items-center px-5">
                <a href="{{route('home')}}" class="flex items-center gap-2 text-slate-900"><img class="w-5" src="{{asset('assets/img/back.svg')}}" alt=""><span class="font-bold text-base">Home</span></a>
                <h1 class="font-extrabold font-title text-xl uppercase text-slate-900">Dashboard Admin</h1>
                @if(auth()->user()->profile_image)
                <img class="w-9 h-9 rounded-full border-2 border-white object-cover" src="{{ asset('storage/' . auth()->user()->profile_image) }}" alt="{{auth()->user()->name}}">
                @else
                <img class="w-9 h-9 rounded-full border-2 border-white object-cover" src="{{ asset('assets/img/default-profile.png') }}" alt="{{auth()->user()->name}}">
                @endif
            </div>

            <div class="flex pt-20 h-screen">
                <div id="content" class="w-[50%] border-r border-black lg:w-[25%] h-full z-20 bg-white hidden lg:block">
                    <div class="p-4 border-b border-black flex justify-between">
                        <h1 class="font-extrabold text-xl">Content</h1>
                        <button class="lg:hidden" id="hideButton">
                            <img src="{{asset('assets/img/x.svg')}}" alt="">
                        </button>
                    </div>
                    <div class="mt-2 px-2">
                        <a href="/dashboard/admin" class="{{ Request::is('dashboard/admin*') ? 'bg-[#e5e5e7] text-black ' : '' }} shadow-md flex justify-between px-2 py-3 rounded-lg">
                            <span class="font-bold">Post</span>
                            <img src="{{ asset('assets/img/arrow.svg') }}" alt="">
                        </a>
                    </div>

                    <div class="mt-2 px-2">
                        <a href="/dashboard/kategori" class="{{ Request::is('dashboard/kategori*') ? 'bg-[#e5e5e7] text-black' : '' }} shadow-md flex justify-between px-2 py-3 rounded-lg">
                            <span class="font-bold">Kategori</span>
                            <img src="{{ asset('assets/img/arrow.svg') }}" alt="">
                        </a>
                    </div>

                    <div class="mt-2 px-2">
                        <a href="/dashboard/laporan" class="{{ Request::is('dashboard/laporan*') ? 'bg-[#e5e5e7] text-black' : '' }} shadow-md flex justify-between px-2 py-3 rounded-lg">
                            <span class="font-bold">Laporan</span>
                            <img src="{{ asset('assets/img/arrow.svg') }}" alt="">
                        </a>
                    </div>
                </div>

                @yield('content')

            </div>
        </div>
    </div>

    </div>

    <script>
        document.getElementById('showButton').addEventListener('click', function() {
            var content = document.getElementById('content');
            content.classList.remove('hidden');
            content.classList.add('fixed');
        });

        document.getElementById('hideButton').addEventListener('click', function() {
            var content = document.getElementById('content');
            content.classList.add('hidden');
            content.classList.remove('fixed');
        });

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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Select all forms on the page
            const forms = document.querySelectorAll('form');

            forms.forEach(form => {
                form.addEventListener('submit', function(event) {
                    // Select the submit button within the form
                    const submitButton = form.querySelector('button[type="submit"]');

                    // Disable the submit button
                    submitButton.disabled = true;
                });
            });
        });

    </script>
</body>
</html>
