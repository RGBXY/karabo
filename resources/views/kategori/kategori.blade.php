<x-app-layout>
    <div class="w-full h-full pt-20">
        <div class="w-[670px] mx-auto">
            <h1 class="text-2xl font-extrabold font-title border-b py-3 ">Pilih topik yang sesuai dengan mu 🤩</h1>
            <div class="flex flex-wrap gap-5 justify-between my-7">
                @foreach ($kategoris as $kategori)
                <a href="/?kategori={{$kategori->slug}}" class="w-[320px] h-36 flex bg-slate-200 justify-center rounded-xl overflow-hidden">
                    @foreach($kategori->post->take(1) as $item)
                    @if($item->image)
                    <div class="w-[40%]">
                        <img class="w-full h-full object-cover" src="{{asset('storage/' . $item->image)}}" alt="halo">
                    </div>
                    @endif
                    @endforeach
                    <div class="w-[60%] flex justify-center items-center">
                        <p class="font-bold font-title text-xl">{{$kategori->nama_kategori}}</p>
                    </div>
                </a>
                @endforeach

                @include('components.create-modal')

            </div>
        </div>
    </div>
</x-app-layout>
