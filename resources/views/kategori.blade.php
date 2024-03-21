<x-app-layout>
<body class="antialiased">
    <div class="sm:flex min-h-screen">
        <div class="pt-20 mx-auto flex items-center w-full flex-col">
            <div class="bg-cyan-700 w-[90%] lg:w-[50%] p-3 rounded-xl border-2 border-black">
                <h1 class="font-bold text-2xl mb-2">Kategori</h1>
                <div class="flex flex-col rounded-xl overflow-hidden">
                    @foreach ($kategoris as $kategori)
                    <a class="bg-cyan-800 p-3 w-full hover:bg-cyan-900 transition-all" href="/kategori/{{$kategori->slug}}">{{$kategori->nama_kategori}}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</body>
</html>
</x-app-layout>