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
    <div class="min-h-screen bg-gray-100">
        <!-- Page Heading -->
        @if (isset($header))
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endif

        <!-- Page Content -->
        <div>
            @if(session()->has('success'))
            <div>
                {{session('success')}}
            </div>
            @endif
        </div>

        <div class="h-full">
            <div class="w-full h-20 bg-[#008EDA] fixed flex justify-between items-center px-5">
                <a href="{{route('home')}}" class="flex items-center gap-2"><img width="19px" src="{{asset('assets/img/back.svg')}}" alt=""><span class="font-bold text-lg">Home</span></a>
                <h1 class="font-bold text-2xl">Dashboard</h1>
                <div class="relative inline-flex items-center justify-center w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                    <span class="font-medium text-gray-600 dark:text-gray-300">JL</span>
                </div>
            </div>

            <div class="flex pt-20 h-screen">
                <div class="w-[25%] h-full border-r border-black bg-[#EEF6FF] ">
                    <h1 class="p-4 border-b border-black  font-extrabold text-xl">Content</h1>
                    <div class="mt-2 px-2">
                        <a href="" class="flex justify-between px-2 py-3 rounded-lg bg-slate-500"><span class="font-bold text-slate-200">Post</span><img src="{{asset('assets/img/arrow.svg')}}" alt=""></a>
                    </div>
                    <div class="mt-2 px-2">
                        <a href="" class="flex justify-between px-2 py-3 rounded-lg"><span class="font-bold ">Jawaban</span><img src="{{asset('assets/img/arrow.svg')}}" alt=""></a>
                    </div>
                </div>

                @yield('content')

            </div>
        </div>
    </div>

    </div>

</body>
</html>
