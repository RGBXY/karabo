<x-app-layout>
    <div class="lg:w-[1200px] h-full flex justify-evenly mx-auto">

        <div class="w-[700px] px-6 pt-28">

            @if(session()->has('success'))
            <div id="alert-3" class="flex items-center p-4 mb-5 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div class="ms-3 text-sm font-medium">
                    {{session('success')}}
                </div>
                <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-3" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
            @endif

            <div class="flex justify-between items-center w-full">
                <h1 class="font-extrabold font-title text-2xl md:text-4xl">Pertanyaan</h1>
                <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="py-2 px-3 gap-0.5 bg-[#1a8917] rounded-3xl hidden md:block">
                    <span class="text-white font-title text-sm">Tambah Pertanyaan</span>
                </button>
            </div>
            <div class="flex mb-9 border-b py-10 relative">
                <a class="absolute pb-4 font-bold border-b border-black" href="{{route('dashboard')}}">Pertanyaan</a>
                <a class="absolute left-28" href="{{route('dashboard_jawaban')}}">Jawaban</a>
            </div>
            @foreach($posts->reverse() as $post)
            <div class="pb-7 mt-5 border-b {{ $post->status == 1 ? ' bg-red-300 p-5 rounded-lg ' : '' }}">
                @if($post->status == 1)
                <div class="flex gap-2 mb-1 bg-red-400 text-red-900 rounded-lg p-2">
                    <img class="w-12" src="{{asset('assets/img/info-error.svg')}}" alt="">
                    <div>
                        <p class="font-bold text-lg">Post mu di suspend</p>
                        <a href="{{route('suspend')}}" class="underline">
                            <p>pelajari lebih lanjut</p>
                        </a>
                    </div>
                </div>
                @endif
                <h1 class="font-title font-bold text-lg break-all">{!!$post->judul_post!!}</h1>
                <p class="text-slate-600 mb-1">{{$post->kategori->nama_kategori}}</p>
                <div class="flex items-center gap-3">
                    <p class="text-sm">{{$post->created_at->format('d M Y')}}</p>
                    <button id="dropdownDefaultButton-{{$post->id}}" data-dropdown-toggle="dropdown-{{$post->id}}" class="text-white" type="button">
                        <span class="text-black">•••</span>
                    </button>
                </div>
            </div>

            {{$posts->links()}}


            <!-- Dropdown menu -->
            <div id="dropdown-{{$post->id}}" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-lg border w-44">
                <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownDefaultButton-{{$post->id}}">
                    <li>
                        <a href="/post/{{$post->slug}}" class="w-full text-start font-bold px-4 py-2 hover:bg-gray-100" type="button">
                            View
                        </a>
                    </li>
                    <li>
                        <button data-modal-target="edit-modal-{{$post->id}}" data-modal-toggle="edit-modal-{{$post->id}}" class="w-full text-start font-bold px-4 py-2 hover:bg-gray-100" type="button">
                            Edit
                        </button>
                    </li>
                    <li>
                        <button data-modal-target="popup-modal-{{$post->id}}" data-modal-toggle="popup-modal-{{$post->id}}" class="w-full text-start text-red-500 font-bold px-4 py-2 hover:bg-gray-100" type="button">
                            Delete
                        </button>
                    </li>
                </ul>
            </div>

            <!-- Modal Delete -->
            @include('components.delete-post-modal')

            <!-- Modal Edit -->
            @include('components.edit-post-modal')

            @endforeach
            <!-- Modal Create -->
            @include('components.create-modal')

        </div>
        <div class="w-[350px] h-screen sticky top-0 pt-20 px-10 bg-white border-l border-slate-200 hidden lg:block">
            @include('components.side-content')
        </div>
    </div>
</x-app-layout>
