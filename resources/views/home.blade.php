<x-app-layout>
    <div class="flex justify-center gap-5 w-full bg-cyan-800 min-h-screen pt-20 ">
        <div class="flex flex-col gap-3 h-full">
            @foreach ($posts as $post)
            <div class="bg-cyan-700 w-[600px] h-auto rounded-xl border-2 border-black p-3">
                <div class="flex items-center gap-2 mb-1">
                    @if($post->user->profile_image)
                    <img class="w-14 h-14 rounded-full border-2 border-white object-cover" src="{{ asset('storage/' . $post->user->profile_image) }}" alt="{{$post->kategori->nama_kategori}}">
                    @else
                    <img class="w-14 h-14 rounded-full border-2 border-white object-cover" src="{{ asset('assets/img/default-profile.png') }}" alt="{{$post->kategori->nama_kategori}}">
                    @endif
                    <div>
                        <p class="text-lg font-bold text-white">{{$post->user->name}}</p>
                        <p class="text-white text-sm">{{$post->created_at->diffForHumans()}}</p>
                    </div>
                </div>
                <a class="text-white text-xl font-bold" href="/post/{{$post->slug}}">{{$post->judul_post}}</a>
                <div class="py-2">
                    <a class="bg-red-500 py-1 px-2 rounded-xl" href="/kategori/{{$post->kategori->slug}}">{{$post->kategori->nama_kategori}}</a>
                </div>
                @if($post->image)
                <img src="{{asset('storage/' . $post->image)}}" alt="{{$post->kategori->nama_kategori}}">
                @else
                {{-- <img src="https://source.unsplash.com/1200x400?{{$post->kategori->nama_kategori}}" alt="{{$post->kategori->nama_kategori}}"> --}}
                @endif
                <div>
                    <form action="{{ route('jawaban_store') }}" method="post">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <input type="hidden" name="parent" value="0">
                        <textarea name="jawaban_konten" id="jawaban" cols="30" rows="10" required></textarea>
                        <input class="bg-red-400 cursor-pointer" type="submit" value="Kirim Jawaban">
                    </form>
                </div>


                <div>
                    @foreach($post->jawaban as $jawaban)
                    @if($jawaban->user->profile_image)
                    <img class="w-14 h-14 rounded-full border-2 border-white object-cover" src="{{ asset('storage/' . $jawaban->user->profile_image) }}" alt="{{$post->kategori->nama_kategori}}">
                    @else
                    <img class="w-14 h-14 rounded-full border-2 border-white object-cover" src="{{ asset('assets/img/default-profile.png') }}" alt="{{$post->kategori->nama_kategori}}">
                    @endif

                    {{$jawaban->jawaban_konten}}
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>

        <div class="w-[20%] p-3">
            <a href="" class="flex items-center bg-cyan-500 mb-2 p-3 hover:bg-slate-400 transition-all">
                <img width="25px" src="{{asset('assets/img/tambah.svg')}}" alt="">
                <span>Buat Kategori</span>
            </a>
            @foreach($kategoris as $kategori)
            <a href="/kategori/{{$kategori->slug}}" class="mb-2 flex items-center bg-cyan-600 p-3 hover:bg-slate-400 transition-all">
                <span>{{$kategori->nama_kategori}}</span>
            </a>
            @endforeach
        </div>
    </div>
</x-app-layout>
