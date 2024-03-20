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
    </head>
    {{-- <body class="font-sans text-gray-900  antialiased">
        <div class="h-screen w-full md:pt-0 lg:bg-slate-100 flex">
            <div class="w-full h-auto md:h-full md:max-w-md px-6 py-4  bg-white overflow-hidden md:rounded-lg">
                <div class="flex justify-between items-center">
                    <a href="/">
                        <x-application-logo class="w-14 h-14 fill-current text-gray-500" />
                    </a>
                    <div class="flex items-center">
                        <p class="mr-3 text-sm">Don't have an account?</p>
                        @if(Request::is('register'))
                        <a class="text-sm border-[1.5px] border-slate-300 py-1 px-2 rounded-lg font-medium shadow-sm text-slate-700 hover:bg-slate-300 hover:text-black transition-all" href="{{route('login')}}">Login</a>
                        @elseif(Request::is('login'))
                        <a class="text-sm border-[1.5px] border-slate-300 py-1 px-2 rounded-lg font-medium shadow-sm text-slate-700 hover:bg-slate-300 hover:text-black transition-all" href="{{route('register')}}">Register</a>
                        @endif
                    </div>
                </div>
                <div class="mt-16 pb-10">
                    {{ $slot }}
                </div>
            </div>
            <div>
                ghjab
            </div>
        </div>
    </body> --}}
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div>
            </div>
            
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <a href="/">
                    <x-application-logo class="mx-auto w-20 h-20 fill-current text-gray-500" />
                </a>
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
