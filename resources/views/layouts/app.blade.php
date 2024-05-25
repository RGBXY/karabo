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

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

    <style>
        .ck-editor__editable_inline {
            min-height: 200px;
        }

        button:disabled {
            cursor: not-allowed;
        }

    </style>


</head>
<body class="font-sans antialiased">
    <div class="h-screen w-full flex flex-col justify-between">

        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>

        <footer class="bg-slate-200 shadow border-t border-slate-400">
            <div class="">
                <div class=" w-full max-w-screen-lg mx-auto p-4 md:py-8">
                    <div class="sm:flex sm:items-center sm:justify-between">
                        <a href="{{route('home')}}" class="flex items-center mb-4 sm:mb-0 space-x-3 rtl:space-x-reverse">
                            <x-application-logo class="block w-20 lg:w-28 fill-current text-gray-800" />
                        </a>
                        <ul class="flex flex-wrap items-center mb-6 text-sm font-medium text-black sm:mb-0">
                            <li>
                                <a href="{{'/'}}" class="hover:underline me-4 md:me-6">Home</a>
                            </li>
                            <li>
                                <a href="{{route('jawab')}}" class="hover:underline me-4 md:me-6">Jawab Pertanyaan</a>
                            </li>
                            <li>
                                <a href="{{route('kategoris')}}" class="hover:underline me-4 md:me-6">Topik</a>
                            </li>
                        </ul>
                    </div>
                    <hr class="my-6 border-slate-900 sm:mx-auto lg:my-8" />
                    <span class="block text-sm text-black sm:text-center">© 2023 <a href="#" class="hover:underline">Karabo™ </a>. All Rights Reserved.</span>
                </div>
            </div>
        </footer>


    </div>

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
