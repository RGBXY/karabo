<div class="w-[100%] h-auto p-3 border-b border-slate-200 pt-5 pb-10 ">
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

        <div class="flex justify-between w-full">
            <div class="w-[70%]">
                <a class=" text-xl font-extrabold font-title mb-10" href="/post/{{$post->slug}}">
                    <p>{!!$post->judul_post!!} </p>
                </a>
                <div class="flex items-center gap-2 mt-7">
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
            <div class="bg-neutral-700 h-[130px] w-[130px]">
                <img class="h-full mx-auto object-cover" src="{{asset('storage/' . $post->image)}}" alt="{{$post->kategori->nama_kategori}}">
            </div>
            @endif
        </div>

    </div>

    <!-- Modal toggle -->
    @include('components.create-modal')

</div>
