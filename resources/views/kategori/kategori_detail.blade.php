{{-- <x-app-layout>
    <div class="flex items-start justify-center w-full bg-[#eaeaea] min-h-screen pt-20">
        <div class="flex flex-col gap-3 h-full w-[50%] items-center">
            @foreach ($posts->reverse() as $post)
            <div class="bg-white w-[100%] h-auto rounded-xl border-2 border-slate-300 p-3">
                <div class="flex items-center gap-2 mb-1">
                    @if($post->user->profile_image)
                    <img class="w-14 h-14 rounded-full border-2 border-white object-cover" src="{{ asset('storage/' . $post->user->profile_image) }}" alt="{{$post->kategori->nama_kategori}}">
@else
<img class="w-14 h-14 rounded-full border-2 border-white object-cover" src="{{ asset('assets/img/default-profile.png') }}" alt="{{$post->kategori->nama_kategori}}">
@endif
<div>
    <p class="font-bold">{{$post->user->name}}</p>
    <div class="flex gap-1">
        <a href="/kategori/{{$post->kategori->slug}}">
            <p class="text-sm">{{$post->kategori->nama_kategori}} •</p>
        </a>
        <p class=" text-sm">{{$post->created_at->diffForHumans()}}</p>
    </div>
</div>
</div>
<a class=" text-xl font-bold" href="/post/{{$post->slug}}">{!!$post->judul_post!!}</a>
@if($post->image)
<div class="bg-neutral-700 rounded-lg overflow-hidden my-4">
    <img class="max-h-[500px] mx-auto object-contain" src="{{asset('storage/' . $post->image)}}" alt="{{$post->kategori->nama_kategori}}">
</div>
@endif

<!-- Modal toggle -->
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

@include('components.notification')
</div>
</div>
</x-app-layout> --}}
