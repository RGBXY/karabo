@if($post->status == 1 && auth()->check() && !auth()->user()->hasRole('admin'))
<div class="w-full h-auto p-3 border-b border-slate-200 min-h-[10rem] flex justify-center items-center gap-3">
    <img class="w-20 md:w-16" src="{{asset('assets/img/info.svg')}}" alt="">
    <div>
        <h1 class="text-xl md:text-2xl font-bold hidden md:block">Post ini di suspend</h1>
        <p class="text-sm md:text-base font-bold md:font-normal">Pertanyaan ini di suspend karena memancing opini yang tidak baik.</p>
        {{-- @if(auth()->check()  && auth()->user()->hasRole('admin'))
        <button data-modal-target="popup-modals-{{$post->id}}" data-modal-toggle="popup-modals-{{$post->id}}" class="bg-blue-500 p-2 mt-2 text-white font-bold rounded-lg inline" type="button">
        Aktifkan Post
        </button>
        <div id="popup-modals-{{$post->id}}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow">
                    <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="popup-modals-{{$post->id}}">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-4 md:p-5 text-center">
                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <h3 class="mb-5 text-lg font-normal text-black">Yakin mau mengaktifkan post ini?</h3>
                        <div class="flex justify-center">
                            <form action="{{ route('unsuspend.post', ['id' => $post->id]) }}" method="POST">
                                @csrf
                                @method('POST')
                                <button type="submit" data-modal-hide="popup-modals-{{$post->id}}" class="text-white bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">Aktifkan</button>
                            </form>
                            <button data-modal-hide="popup-modals-{{$post->id}}" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:z-10 focus:ring-4 focus:ring-gray-100">Tidak, Batalkan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else --}}
        <a href="{{route('suspend')}}" class="text-blue-600 hover:text-blue-700 underline text-sm">Pelajari lebih lanjut</a>
        {{-- @endif --}}
    </div>
</div>
@else

@endif

@if($post->status == 0 || auth()->check() && $post->status == 1 && auth()->user()->hasRole('admin'))
<div class="w-[100%] h-auto pt-4 px-6 md:pt-5">
    <div class="border-b border-slate-200 pb-5 md:pb-10">
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

        <div class="flex flex-row justify-between w-full">
            <div class="{{ $post->image ? 'md:w-[70%]' : 'w-full' }} w-full">
                <a class=" text-lg lg:text-xl font-semibold font-title mb-10" href="/post/{{$post->slug}}">
                    <p class="">{!!$post->judul_post!!} </p>
                </a>
                <div class="flex items-center justify-between md:justify-start gap-2 mt-5">
                    <a href="/?kategori={{$post->kategori->slug}}" class="bg-slate-200 py-1 text-sm px-2 rounded-3xl">
                        <p class="text-sm">{{$post->kategori->nama_kategori}} </p>
                    </a>

                    <div class="flex items-center gap-2">
                        @if($post->hasAnswer())
                        <a href="/post/{{$post->slug}}/#jawaban" class="bg-slate-900 py-1 text-white text-sm px-4 rounded-3xl">
                            Jawaban {{$jawabanPerPost[$post->id]}}
                        </a>
                        @else
                        <a href="/post/{{$post->slug}}" class="bg-slate-900 py-1 text-white text-sm px-4 rounded-3xl font-bold">
                            Jawab
                        </a>
                        @endif

                        @if($post->status == 1)
                        <p class="bg-red-600 py-1 text-white text-sm px-4 rounded-3xl font-bold">Post di suspen</p>
                        @endif
                    </div>
                </div>
            </div>
            @if($post->image)
            <div class="bg-slate-800 mb-2 h-[130px] w-[130px] object-cover hidden md:block">
                <img class="h-full object-cover mx-auto" src="{{asset('storage/' . $post->image)}}" alt="{{$post->kategori->nama_kategori}}">
            </div>
            @endif
        </div>

    </div>
</div>
@endif

<!-- Modal toggle -->
@include('components.create-modal')
