<x-app-layout>

    <div class="mx-10 h-full pt-20">
        <h1 class="text-2xl font-bold border-b-2 border-black pb-3 ">Pilih topik yang sesuai dengan mu 🤩</h1>
        @foreach ($kategoris as $kategori)
        <div class="py-5">
            <div class="flex items-center justify-between">
                <p class="py-3 font-bold text-xl">{{$kategori->nama_kategori}}</p>
                <a class="flex items-center gap-1" href="/kategori/{{$kategori->slug}}">
                    <p class="underline">selengkapnya </p>
                    <img src="{{asset('assets/img/arrow.svg')}}" alt="">
                </a>
            </div>
            <div class="flex flex-wrap gap-5">
                @foreach ($kategori->post->shuffle()->take(3) as $post)
                <div class="w-[380px] min-h-[180px] bg-white shadow-md border border-slate-200 p-4 flex flex-col justify-between rounded-2xl">
                    <div class="flex items-center gap-2">
                        @if($post->user->profile_image)
                        <img class="w-12 h-12 rounded-full border-2 border-white object-cover" src="{{ asset('storage/' . $post->user->profile_image) }}" alt="{{$post->kategori->nama_kategori}}">
                        @else
                        <img class="w-12 h-12 rounded-full border-2 border-white object-cover" src="{{ asset('assets/img/default-profile.png') }}" alt="{{$post->kategori->nama_kategori}}">
                        @endif
                        <div>
                            <h1>{{$post->user->name}}</h1>
                            <h1 class="text-sm">{{$post->created_at->diffForHumans( )}}</h1>
                        </div>
                    </div>
                    <a href="/post/{{$post->slug}}" class="text-xl font-bold hover:underline">{!!$post->judul_post!!}</a>

                    <div class="flex items-center justify-between mt-3">
                        <a href="/post/{{$post->slug}}" data-modal-target="crud-modal-{{$post->id}}" data-modal-toggle="crud-modal-{{$post->id}}" class=" block text-black font-extrabold border-2 border-black hover:bg-slate-300 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-3xl text-sm px-4 py-1 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition-all" type="button">
                            Jawab
                        </a>
                        <div class="flex gap-3 items-center">
                            <p class="border-2 border-black py-1 text-sm px-4 rounded-3xl">Jawaban {{$jawabanPerPost[$post->id]}}</p>
                            <button class="hover:bg-pink-100 rounded-lg p-1">❤️ <span>0</span></button>
                        </div>
                    </div>
                
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>

    {{-- @foreach ($kategoris as $kategori)
    <a class="bg-cyan-800 p-3 w-full hover:bg-cyan-900 transition-all" href="/kategori/{{$kategori->slug}}">{{$kategori->nama_kategori}}</a>
    @endforeach --}}

</x-app-layout>
