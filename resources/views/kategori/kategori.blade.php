<x-app-layout>
    <div class="w-full h-full pt-20">
        <div class="md:w-[670px] w-[90%] mx-auto flex flex-col justify-center items-center md:block">
            <h1 class="text-2xl font-extrabold font-title border-b py-3 ">Pilih topik yang sesuai dengan mu 🤩</h1>
            <div class="flex flex-wrap gap-5 justify-between mx-auto my-7">
                @foreach ($kategoris as $kategori)
                <a href="/?kategori={{$kategori->slug}}" class="md:w-[320px] w-full h-36 flex mx-auto bg-slate-200 justify-center rounded-xl overflow-hidden">
                    @foreach($kategori->post->shuffle()->take(1) as $item)
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
                @if(auth()->check())
                @include('components.notification')
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
