<x-app-layout>
    <div class="pt-20 rounded-xl flex justify-center gap-5">
        <div class="bg-cyan-700 rounded-xl w-[50%] p-4">
            <div class="flex">
                @if($post->user->profile_image)
                <img class="w-11 h-11 rounded-full object-cover" src="{{ asset('storage/' . $post->user->profile_image) }}" alt="{{$post->kategori->nama_kategori}}">
                @else
                <img class="w-11 h-11 rounded-full object-cover" src="{{ asset('assets/img/default-profile.png') }}" alt="{{$post->kategori->nama_kategori}}">
                @endif
                <div class="">
                    <p>{{$post->user->name}}</p>
                    <p>{{$post->created_at->diffForHumans()}}</p>
                </div>
            </div>

            <h1>{{$post->judul_post}}</h1>
            <a href="/kategori/{{$post->kategori->slug}}">{{$post->kategori->nama_kategori}}</a>
        </div>
        <div class="w-[20%] bg-slate-400">
            user
        </div>
    </div>
</x-app-layout>
