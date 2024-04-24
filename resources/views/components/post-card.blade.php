@if($post->status == 1)
<div class="w-[100%] h-auto p-3 border-b border-slate-200 min-h-[10rem] flex justify-center items-center gap-3">
    <img class="w-14" src="{{asset('assets/img/info.svg')}}" alt="">
    <div>
        <h1 class="text-2xl font-bold">Post di blokir</h1>
        <p>Post ini di nonaktifkan oleh admin karena berisi konten yang tidak baik</p>
    </div>
</div>
@else
<div class="w-[100%] h-auto p-3 border-b border-slate-200 pt-5 pb-10">
    <div class="">
        <div class="flex items-center gap-2 mb-3">
            @if($post->user->profile_image)
            <img class="w-7 h-7 rounded-full border-2 border-white object-cover" src="{{ asset('storage/' . $post->user->profile_image) }}" alt="{{$post->kategori->nama_kategori}}">
            @else
            <img class="w-7 h-7 rounded-full border-2 border-white object-cover" src="{{ asset('assets/img/default-profile.png') }}" alt="{{$post->kategori->nama_kategori}}">
            @endif
            <div class="flex gap-1 items-center">
                <p class="font-medium font-title">{{$post->user->name}} · </p>
                <p class=" text-sm text-slate-600">{{$post->created_at->format('d M Y')}}</p>
            </div>
        </div>

        <div class="flex flex-col-reverse lg:flex-row justify-between w-full">
            <div class="lg:w-[70%]">
                <a class=" text-lg lg:text-xl font-extrabold font-title mb-10" href="/post/{{$post->slug}}">
                    <p>{!!$post->judul_post!!} </p>
                </a>
                <div class="flex items-center gap-2 mt-5">
                    <a href="/?kategori={{$post->kategori->slug}}" class="bg-slate-200 py-1 text-sm font-medium px-2 rounded-3xl">
                        <p class="text-sm">{{$post->kategori->nama_kategori}} </p>
                    </a>
                    @if($post->hasAnswer())
                    <a href="/post/{{$post->slug}}/#jawaban" class="bg-slate-900 py-1 text-white text-sm px-4 rounded-3xl">
                        Jawaban {{$jawabanPerPost[$post->id]}}
                    </a>
                    @else
                    <a href="/post/{{$post->slug}}" class="bg-slate-900 py-1 text-white text-sm px-4 rounded-3xl">
                        Jawab Pertanyaan
                    </a>
                    @endif
                </div>
            </div>
            @if($post->image)
            <div class="bg-slate-800 mb-2 h-[300px] w-full lg:h-[130px] lg:w-[130px] object-cover">
                <img class="h-full object-cover mx-auto" src="{{asset('storage/' . $post->image)}}" alt="{{$post->kategori->nama_kategori}}">
            </div>
            @endif
        </div>

    </div>
</div>
@endif

<!-- Modal toggle -->
@include('components.create-modal')
