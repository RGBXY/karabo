<x-app-layout>
    <div class="flex items-start justify-evenly w-[1200px] min-h-screen pt-16 mx-auto">

        {{-- Post-Container --}}
        <div class="flex flex-col gap-3 h-full w-[700px] items-center ">
            @foreach ($posts as $post)
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
                                <a href="/post/{{$post->slug}}" class=" bg-slate-200 py-1 text-sm px-4 rounded-3xl">
                                    Jawaban {{$jawabanPerPost[$post->id]}}
                                </a>
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
            @endforeach
        </div>

        {{-- Side-Content-Container --}}
        <div class="w-[350px] h-full sticky top-16 py-4 px-10 bg-white border-l border-slate-200">
            <div class="Pengguna-Teraktif">
                <h1 class="mb-3 text-xl font-bold">😎 Pengguna Teraktif</h1>
                @foreach($user_top as $user)
                <div class="flex items-center mb-2 justify-between text-sm">
                    <div class="flex items-center gap-2">
                        @if($user->profile_image)
                        <img class="w-10 h-10 rounded-full border-2 border-white object-cover" src="{{ asset('storage/' . $user->profile_image) }}" alt="{{$post->kategori->nama_kategori}}">
                        @else
                        <img class="w-10 h-10 rounded-full border-2 border-white object-cover" src="{{ asset('assets/img/default-profile.png') }}" alt="Profile">
                        @endif
                        <p>{{$user->name}}</p>
                    </div>
                    <p> <span class="font-extrabold">{{ $user->jawaban_count }} </span> Jawaban</p>
                </div>
                @endforeach
            </div>


        </div>

    </div>


</x-app-layout>
