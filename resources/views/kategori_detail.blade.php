<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite('resources/css/app.css')

</head>
<body class="antialiased">
    <div class="sm:flex min-h-screen justify-center">
        @if (Route::has('login'))
        <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10 w-full bg-cyan-950 border-b-2 border-black">
            @auth

            @if(auth()->user()->hasRole('admin'))
            <a href="{{ url('/dashboard-admin') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-slate-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
            @endif

            @if(auth()->user()->hasRole('pengguna'))
            <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-slate-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
            @endif


            @else
            <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-slate-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-slate-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
            @endif
            @endauth
        </div>
        @endif

        <div class="pt-20 mx-20">
            <h1 class="py-3 font-bold text-xl">Post dengan kategori : {{$kategoris}}</h1>
            <div class="flex justify-center w-full flex-col items-center gap-5">
                @foreach ($posts as $post)
                <div class="bg-cyan-700 w-[500px] h-auto rounded-xl border-2 border-black p-3">
                    <div class="flex items-center gap-2 mb-1">
                        <img class="w-14 h-14 rounded-full border-2 border-white" src="https://nugrahayoganugraha.files.wordpress.com/2012/01/kamus_bahasa_alay.jpg?w=640" alt="">
                        <div>
                            <p class="text-lg font-bold text-white">{{$post->user->name}}</p>
                            <p class="text-white text-sm">{{$post->created_at->diffForHumans()}}</p>
                        </div>

                    </div>
                    <a class="text-white text-xl font-bold" href="/post/{{$post->slug}}">{{$post->judul_post}}</a>
                    @if($post->image)
                    <img class="mt-2" src="{{asset('storage/' . $post->image)}}" alt="{{$post->kategori->nama_kategori}}">
                    @else
                    <img src="https://source.unsplash.com/1200x400?{{$post->kategori->nama_kategori}}" alt="{{$post->kategori->nama_kategori}}">
                    @endif
                </div>
                @endforeach
            </div>
        </div>


    </div>
</body>
</html>
