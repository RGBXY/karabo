<x-app-layout>
    <div class="lg:w-[1200px] h-full flex justify-evenly mx-auto">
        @if(session()->has('success'))
        <div id="alert-3" class="flex items-center p-4 mb-5 mt-16 left-0 right-0 fixed z-50 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
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
        <div class="w-[700px] pt-28 px-6 h-full">

            <div class="flex justify-between items-center w-full">
                <h1 class="font-extrabold font-title text-2xl md:text-4xl">Jawaban</h1>
                <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="py-2 px-3 gap-0.5 bg-[#1a8917] rounded-3xl hidden md:block">
                    <span class="text-white font-title text-sm">Tambah Pertanyaan</span>
                </button>
            </div>
            <div class="flex mb-9 border-b py-10 relative">
                <a class="absolute" href="{{route('dashboard')}}">Pertanyaan</a>
                <a class="absolute left-28 font-bold border-b border-black pb-4" href="{{route('dashboard_jawaban')}}">Jawaban</a>
            </div>
            @foreach($jawabans->reverse() as $jawaban)
            <div class="pb-7 mt-5 border-b {{ $jawaban->status == 1 ? ' bg-red-300 p-5 rounded-lg ' : '' }}">

                <div class="flex items-center gap-2">

                    @if($jawaban->user->profile_image)
                    <img class="w-11 h-11 rounded-full border-2 border-white object-cover" src="{{ asset('storage/' . $jawaban->user->profile_image) }}" alt="{{$jawaban->post->kategori->nama_kategori}}">
                    @else
                    <img class="w-11 h-11 rounded-full border-2 border-white object-cover" src="{{ asset('assets/img/default-profile.png') }}" alt="{{$jawaban->post->kategori->nama_kategori}}">
                    @endif
                    <div class="items-center gap-3">
                        <p><span class="font-bold">Kamu</span> menjawab <a class="font-bold break-all hover:underline" href="/post/{{$jawaban->post->slug}}">{{ Illuminate\Support\Str::words($jawaban->post->judul_post, 10, '...') }}</a></p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-1 text-slate-700">
                                <p class="text-sm">{{$jawaban->created_at->format('d M Y')}} ·</p>
                                <p>{{$jawaban->post->kategori->nama_kategori}}</p>
                            </div>
                            <button id="dropdownDefaultButton-{{$jawaban->id}}" data-dropdown-toggle="dropdown-{{$jawaban->id}}" class="text-white" type="button">
                                <span class="text-black">•••</span>
                            </button>
                        </div>
                    </div>
                </div>

                <h1 class="font-title font-semibold mt-3">{!!$jawaban->jawaban_konten!!}</h1>

                @if($jawaban->status == 1)
                <div class="flex gap-2 mt-2 bg-red-400 text-red-900 rounded-lg p-2">
                    <img class="w-12" src="{{asset('assets/img/info-error.svg')}}" alt="">
                    <div>
                        <p class="font-bold text-lg">Jawaban mu di suspend</p>
                        <a href="{{route('suspend')}}" class="underline">
                            <p>pelajari lebih lanjut</p>
                        </a>
                    </div>
                </div>
                @endif
            </div>

            {{$jawabans->links()}}


            <!-- Dropdown menu -->
            <div id="dropdown-{{$jawaban->id}}" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-lg w-44">
                <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownDefaultButton-{{$jawaban->id}}">
                    <li>
                        <button data-modal-target="edit-modals-{{$jawaban->id}}" data-modal-toggle="edit-modals-{{$jawaban->id}}" class="w-full text-start font-bold px-4 py-2 hover:bg-gray-100  " type="button">
                            Edit
                        </button>
                    </li>
                    <li>
                        <button data-modal-target="popup-modals-{{$jawaban->id}}" data-modal-toggle="popup-modals-{{$jawaban->id}}" class="w-full text-start text-red-500 font-bold px-4 py-2 hover:bg-gray-100 " type="button">
                            Delete
                        </button>
                    </li>
                </ul>
            </div>

            <!-- Modal Delete -->
            @include('components.delete-jawaban-modal')

            <!-- Modal Edit Jawaban -->
            @include('components.edit-jawaban-modal')

            @endforeach

            <!-- Modal Create -->
            @include('components.create-modal')

            {{-- Notif --}}
            @include('components.notification')

        </div>

        <div class="w-[350px] h-screen sticky top-0 pt-20 px-10 bg-white border-l border-slate-200 hidden lg:block">
            @include('components.side-content')
        </div>
    </div>

    @foreach ($jawabans as $jawaban)
    <script>
        ClassicEditor
            .create(document.querySelector('#editor-jawaban-{{$jawaban->id}}'), {
                ckfinder: {
                    uploadUrl: "{{ url('/ckeditor/upload') }}?_token={{ csrf_token() }}"
                }
            })
            .catch(error => {
                console.error(error);
            });

    </script>
    @endforeach

</x-app-layout>
