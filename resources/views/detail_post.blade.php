<x-app-layout>
    <div class="pt-20 rounded-xl flex justify-center gap-5">
        <div class="bg-cyan-700 rounded-xl w-[50%] ">
            @if($post->user->profile_image)
            <img class="w-14 h-14 rounded-full border-2 border-white object-cover" src="{{ asset('storage/' . $post->user->profile_image) }}" alt="{{$post->kategori->nama_kategori}}">
            @else
            <img class="w-14 h-14 rounded-full border-2 border-white object-cover" src="{{ asset('assets/img/default-profile.png') }}" alt="{{$post->kategori->nama_kategori}}">
            @endif
            <h1>{{$post->judul_post}}</h1>
            <a href="/kategori/{{$post->kategori->slug}}">{{$post->kategori->nama_kategori}}</a>
        </div>
        <div class="w-[20%] bg-slate-400">
            user
        </div>
    </div>
</x-app-layout>
