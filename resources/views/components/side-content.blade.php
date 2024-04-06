<div class="Pengguna-Teraktif">
    <h1 class="mb-4 font-bold">😎 Pengguna Teraktif</h1>
    @foreach($user_top as $user)
    <div class="flex items-center mb-2 justify-between text-sm">
        <div class="flex items-center gap-2">
            @if($user->profile_image)
            <img class="w-10 h-10 rounded-full border-2 border-white object-cover" src="{{ asset('storage/' . $user->profile_image) }}" alt="Gambar Error">
            @else
            <img class="w-10 h-10 rounded-full border-2 border-white object-cover" src="{{ asset('assets/img/default-profile.png') }}" alt="Profile">
            @endif
            <p>{{$user->name}}</p>
        </div>
        <p> <span class="font-extrabold">{{ $user->jawaban_count }} </span> Jawaban</p>
    </div>
    @endforeach
</div>

<div class="mt-12">
    <h1 class="mb-4 font-bold">📰 Rekomendasi Topik</h1>
    <div class="flex flex-row flex-wrap mb-2 gap-2 text-sm">
        @foreach($kategori_top as $kategori)
        <a href="/?kategori={{$kategori->slug}}" class="bg-slate-200 py-1 text-sm font-medium px-2 rounded-3xl">
            <p class="text-sm">{{$kategori->nama_kategori}} </p>
        </a>
        @endforeach
    </div>
</div>
