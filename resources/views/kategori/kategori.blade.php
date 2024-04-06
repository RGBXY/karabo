<x-app-layout>
    <div class="w-full h-full pt-20">
        <div class="w-[670px] mx-auto">
            <h1 class="text-2xl font-extrabold font-title border-b py-3 ">Pilih topik yang sesuai dengan mu 🤩</h1>
            <div class="flex flex-wrap justify-between my-7">
                @foreach ($kategoris as $kategori)
                <a class="w-[320px] h-52 flex justify-center items-center bg-gradient-to-r from-purple-500 to-pink-500 rounded-xl" href="/kategori/{{$kategori->slug}}">
                    <p class="font-bold text-xl">{{$kategori->nama_kategori}}</p>
                </a>
                @endforeach
            </div>
        </div>
    </div>

    {{-- @foreach ($kategoris as $kategori)
    <a class="bg-cyan-800 p-3 w-full hover:bg-cyan-900 transition-all" href="/kategori/{{$kategori->slug}}">{{$kategori->nama_kategori}}</a>
    @endforeach --}}

</x-app-layout>
