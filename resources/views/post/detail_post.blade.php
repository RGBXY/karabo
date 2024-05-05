<x-app-layout>
    <div class="pt-20 rounded-xl flex flex-col items-center justify-center gap-5 w-full">

        <div class="w-full lg:w-[700px] pt-4">

            {{-- Alert --}}
            @if(session()->has('success'))
            <div id="alert-3" class="flex items-center p-4 text-green-800 rounded-lg bg-green-50" role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div class="ms-3 text-sm font-medium">
                    {{session('success')}}
                </div>
                <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 " data-dismiss-target="#alert-3" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
            @endif

            {{-- Pertanyan --}}
            <div class="bg-white rounded-xl p-4">
                <h1 class="text-3xl lg:text-3xl font-[900] font-title">{!!$post->judul_post!!}</h1>
                <div class="flex gap-3 items-center">
                    @if($post->user->profile_image)
                    <img class="w-11 h-11 rounded-full object-cover" src="{{ asset('storage/' . $post->user->profile_image) }}" alt="{{$post->kategori->nama_kategori}}">
                    @else
                    <img class="w-11 h-11 rounded-full object-cover" src="{{ asset('assets/img/default-profile.png') }}" alt="{{$post->kategori->nama_kategori}}">
                    @endif

                    <div class="py-8">
                        <p class="font-bold">{{$post->user->name}}</p>
                        <div class="flex items-center gap-1">
                            <p class="text-sm">{{$post->created_at->format("d M Y")}}</p>
                            <a href="/?kategori={{$post->kategori->slug}}"><span class="text-sm">• {{$post->kategori->nama_kategori}}</span></a>
                        </div>
                    </div>
                </div>

                <div class="flex justify-between w-full mb-10 border-t border-b border-slate-200 py-3 px-1">

                    {{-- Jika Post Memiliki Jawaban --}}
                    @if($post->hasAnswer())
                    <div class="w-full flex flex-col md:flex-row">
                        <div class="flex flex-col w-full md:flex-row lg:items-center gap-3">
                            <div class="py-2 px-3 bg-black text-sm rounded-3xl font-extrabold flex justify-center lg:inline-block">
                                <p class="text-white">Lihat Jawaban <span class="bg-white text-black py-0.5 rounded-full px-2">{{$jawabanPerPost[$post->id]}}</span></p>
                            </div>
                            <div class="flex items-center mb-2 md:m-0">
                                <button data-modal-target="crud-modal-{{$post->id}}" data-modal-toggle="crud-modal-{{$post->id}}" class=" flex items-center justify-center py-1.5 px-3 w-full bg-black text-white rounded-3xl font-bold gap-1 transition-all" type="button">
                                    <img class="w-5" src="{{asset('assets/img/tambah.svg')}}" alt="">
                                    <p>Tambahkan Jawaban</p>
                                </button>
                            </div>
                        </div>

                        <div class="flex items-center justify-end me-1">
                            @if(auth()->check() && $post->user_id === auth()->user()->id)
                            <button id="dropdownDefaultButton-{{$post->id}}" data-dropdown-toggle="dropdown-{{$post->id}}" class="" type="button">
                                <span class="text-black ">•••</span>
                            </button>
                            @endif
                        </div>
                    </div>

                    @else

                    {{-- Jika Post Belum Memiliki Jawaban --}}
                    <div class="flex items-center justify-between">
                        <button data-modal-target="crud-modal-{{$post->id}}" data-modal-toggle="crud-modal-{{$post->id}}" class=" flex items-center py-1.5 px-3 bg-black text-white rounded-3xl font-bold gap-1 transition-all" type="button">
                            <img class="w-5" src="{{asset('assets/img/tambah.svg')}}" alt="">
                            <p>Tambahkan Jawaban</p>
                        </button>
                    </div>


                    <div class="flex items-center justify-end me-1 ">
                        @if(auth()->check() && $post->user_id === auth()->user()->id)
                        <button id="dropdownDefaultButton-{{$post->id}}" data-dropdown-toggle="dropdown-{{$post->id}}" class="" type="button">
                            <span class="text-black">•••</span>
                        </button>
                        @endif
                    </div>

                    @endif

                </div>

                @if($post->image)
                <div class="bg-neutral-700 rounded-lg overflow-hidden mb-4">
                    <img class="max-h-[500px] mx-auto object-contain" src="{{asset('storage/' . $post->image)}}" alt="{{$post->kategori->nama_kategori}}">
                </div>
                @endif

                <!-- Jawaban modal -->
                <div id="crud-modal-{{$post->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full lg:w-[50rem] md:max-w-[80rem] max-h-full z-50">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow">
                            <!-- Modal header -->
                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                                <h3 class="text-lg font-semibold text-gray-900 ">
                                    Jawaban
                                </h3>
                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-toggle="crud-modal-{{$post->id}}">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <form class="p-4 md:p-5" action="{{ route('jawaban_store') }}" method="post">
                                @csrf
                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                <input type="hidden" name="parent" value="0">
                                <input type="hidden" name="verified" value="0">
                                <input type="hidden" name="status" value="0">
                                <div class=" gap-4 mb-4 ">
                                    <div class="min-h-52">
                                        <textarea name="jawaban_konten" id="editor" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Jawaban Anda"></textarea>
                                    </div>
                                </div>
                                <button type="submit" class="text-white inline-flex items-center gap-2 bg-slate-800 hover:bg-slate-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                    <img class="w-5" src="{{asset('assets/img/send.svg')}}" alt="">
                                    <span>Kirim</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Delete Modal --}}
                @include('components.delete-post-modal')

                {{-- Edit Modal --}}
                @include('components.edit-post-modal')

                {{-- Dropdown --}}
                <div id="dropdown-{{$post->id}}" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-lg border w-44">
                    <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownDefaultButton-{{$post->id}}">
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

                @include('components.create-modal')

            </div>

            {{-- Jawaban --}}
            @if($post->hasAnswer())
            <div class="px-4 py-2 text-lg font-bold">Jawaban Terkait ({{$jawabanPerPost[$post->id]}})</div>
            @foreach($post->jawaban()->where('parent', 0)->orderBy('created_at', 'desc')->get() as $jawaban)
            
            @if($jawaban->status == 1)
          
            <div id="jawaban" class="flex justify-center items-center gap-3 bg-white border border-slate-200 mt-5 h-40 lg:w-[670px] w-full mx-auto">
                <img class="w-16" src="{{asset('assets/img/info.svg')}}" alt="">
                <div>
                    <h1 class="text-xl font-bold">Jawaban Telah Di Nonaktifkan</h1>
                    <a href="#"><p class="text-blue-500 hover:text-blue-600 underline mb-2">Pelajari Lebih Lanjut</p></a>
                    @if(Auth::user()->hasRole('admin'))
                        <button data-modal-target="unban-modals-{{$jawaban->id}}" data-modal-toggle="unban-modals-{{$jawaban->id}}" class="px-2 py-1 bg-blue-500 hover:bg-blue-700 text-white hover:text-gray-300 rounded-lg text-start font-semibold" type="button">
                            Buka Ban
                        </button>
                    @endif
                </div>

                <div id="unban-modals-{{$jawaban->id}}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-md max-h-full">
                        <div class="relative bg-white rounded-lg shadow">
                            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="unban-modals-{{$jawaban->id}}">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                            <div class="p-4 md:p-5 text-center">
                                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                <h3 class="mb-5 text-lg font-normal text-black">Yakin mau <span class="text-blue-500">mengaktifkan</span> kembali jawaban ini?</h3>
                                <div class="flex justify-center w-full">
                                    <form action="{{ route('batal.ban.jawaban', ['id' => $jawaban->id]) }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" data-modal-hide="unban-modal-{{$jawaban->id}}" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">Activate</button>
                                    </form>
                                    <button data-modal-hide="unban-modal-{{$jawaban->id}}" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 ">No, cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>    

            @else

            <div id="jawaban" class="bg-white border border-slate-200 mt-5 lg:w-[670px] w-full mx-auto">
                <div class="border-b p-4 flex justify-between">
                    <p class="font-bold text-xl font-title">Jawaban 📖</p>
                    <div class="flex gap-3">

                        @if(auth()->check() && $jawaban->user_id === auth()->user()->id)
                        <button id="dropdownDefaultButtons-{{$jawaban->id}}" data-dropdown-toggle="dropdowns-{{$jawaban->id}}" class="text-white" type="button">
                            <span class="text-black">•••</span>
                        </button>
                        @endif

                        @if(Auth::user()->hasRole('admin'))
                        <button data-modal-target="ban-modals-{{$jawaban->id}}" data-modal-toggle="ban-modals-{{$jawaban->id}}" class="py-1 px-2 rounded-3xl text-white font-bold text-sm hover:text-gray-300 bg-red-500 hover:bg-red-600" type="button">
                            Ban
                        </button>
                        @endif

                        @if($jawaban->verified == 1)
                        <img class="w-8" src="{{asset('assets/img/verified.png')}}" alt="">
                        @else
                        @if(auth()->check() && $jawaban->post->user_id === auth()->user()->id)
                        <form action="{{ route('verifikasi.jawaban', ['id' => $jawaban->id]) }}" method="POST">
                            @csrf
                            @method('POST')
                            <button class="bg-[#1a8917] py-1 px-2 rounded-3xl text-white font-bold text-sm hover:bg-[#1b5019] hover:text-gray-300" type="submit">Verifikasi</button>
                        </form>
                        @endif
                        @endif
                    </div>

                    <div id="dropdowns-{{$jawaban->id}}" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-lg w-44">
                        <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownDefaultButtons-{{$jawaban->id}}">
                            <li>
                                <button data-modal-target="edit-modals-{{$jawaban->id}}" data-modal-toggle="edit-modals-{{$jawaban->id}}" class="w-full text-start font-bold px-4 py-2 hover:bg-gray-100" type="button">
                                    Edit
                                </button>
                            </li>
                            <li>
                                <button data-modal-target="popup-modals-{{$jawaban->id}}" data-modal-toggle="popup-modals-{{$jawaban->id}}" class="w-full text-start text-red-500 font-bold px-4 py-2 hover:bg-gray-100" type="button">
                                    Delete
                                </button>
                            </li>
                        </ul>
                    </div>

                    <!-- Modal Delete Jawaban -->
                    @include('components.delete-jawaban-modal')

                    <!-- Modal Edit Jawaban -->
                    @include('components.edit-jawaban-modal')

                    <!-- Ban Jawaban Modal -->
                    <div id="ban-modals-{{$jawaban->id}}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-md max-h-full">
                            <div class="relative bg-white rounded-lg shadow">
                                <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="ban-modals-{{$jawaban->id}}">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                                <div class="p-4 md:p-5 text-center">
                                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                    <h3 class="mb-5 text-lg font-normal text-black">Yakin mau <span class="text-red-500">menonaktifkan</span> jawaban ini?</h3>
                                    <div class="flex justify-center w-full">
                                        <form action="{{ route('ban.jawaban', ['id' => $jawaban->id]) }}" method="POST">
                                            @csrf
                                            @method('POST')
                                            <button type="submit" data-modal-hide="popup-modal-{{$jawaban->id}}" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">Inactive</button>
                                        </form>
                                        <button data-modal-hide="popup-modal-{{$jawaban->id}}" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 ">No, cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="pt-4 px-4 pb-1">
                    <div class="flex items-center gap-3">
                        @if($jawaban->user->profile_image)
                        <img class="w-9 h-9 rounded-full border-2 border-white object-cover" src="{{ asset('storage/' . $jawaban->user->profile_image) }}" alt="{{$post->kategori->nama_kategori}}">
                        @else
                        <img class="w-9 h-9 rounded-full border-2 border-white object-cover" src="{{ asset('assets/img/default-profile.png') }}" alt="{{$post->kategori->nama_kategori}}">
                        @endif
                        <div>
                            <p class="font-bold">{{$jawaban->user->name}}</p>
                            <p class="text-sm">{{$jawaban->created_at->diffForHumans()}}</p>
                        </div>
                    </div>

                    <div class="mt-5 mb-2 min-h-5 border-b pb-4">
                        <p class="text-base">{!! $jawaban->jawaban_konten !!}</p>
                    </div>

                    <button onclick="toggleKomentarView({{$jawaban->id}})" class="komentar flex items-center gap-1 pb-2">
                        <img class="w-5 h-5" src="{{asset("assets/img/komen.svg")}}" alt=""><span>Komentar</span>
                    </button>

                    <div class="hidden " id="komentar_view-{{$jawaban->id}}">
                        <form action="{{route('jawaban_store')}}" method="post" class="pt-4 pb-2 border-t">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <input type="hidden" name="status" value="0">
                            <input type="hidden" name="parent" value="{{ $jawaban->id }}">
                            <div class="flex justify-between items-center">
                                <textarea name="jawaban_konten" id="editor" required class="p-3 w-[87%] min-h-4 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-0 focus:border-slate-300" placeholder="Komen"></textarea>
                                <button type="submit" class="bg-[#1a8917] py-2 px-4 max-h-12 text-white rounded-3xl">
                                    Kirim
                                </button>
                            </div>
                        </form>

                        @foreach($jawaban->childs as $child)
                        @if($child->status == 1)
                        <div class="px-2 py-5 ml-4 border-l-2 border-gray-300">
                            <div class="flex justify-center items-center mt-4 h-32 bg-slate-300">
                                <p class="text-xl font-bold">Komentar telah di ban</p>
                            </div>
                        </div>
                        @else
                        <div class="px-2 py-5 ml-4 border-l-2 border-gray-300">
                            <div class="flex items-center gap-2">
                                @if($child->user->profile_image)
                                <img class="w-9 h-9 rounded-full border-2 border-white object-cover" src="{{ asset('storage/' . $child->user->profile_image) }}" alt="{{$post->kategori->nama_kategori}}">
                                @else
                                <img class="w-9 h-9 rounded-full border-2 border-white object-cover" src="{{ asset('assets/img/default-profile.png') }}" alt="{{$post->kategori->nama_kategori}}">
                                @endif
                                <div>
                                    <p class="font-bold text-sm">{{ $child->user->name }}</p>
                                    <p class="text-sm">{{ $child->created_at->diffForHumans()}}</p>
                                </div>
                                @if(Auth::user()->hasRole('admin'))
                                <button data-modal-target="ban-kom-modals-{{$child->id}}" data-modal-toggle="ban-kom-modals-{{$child->id}}" class="py-1 px-2 rounded-3xl text-white font-bold text-sm hover:text-gray-300 bg-red-500 hover:bg-red-600" type="button">
                                    Ban
                                </button>

                                <div id="ban-kom-modals-{{$child->id}}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-md max-h-full">
                                        <div class="relative bg-white rounded-lg shadow">
                                            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="ban-kom-modals-{{$child->id}}">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                            <div class="p-4 md:p-5 text-center">
                                                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                </svg>
                                                <h3 class="mb-5 text-lg font-normal text-black">Yakin mau {{$child->jawaban_konten}} <span class="text-red-500">menonaktifkan</span> jawaban ini?</h3>
                                                <div class="flex justify-center w-full">
                                                    <form action="{{ route('ban.jawaban', ['id' => $child->id]) }}" method="POST">
                                                        @csrf
                                                        @method('POST')
                                                        <button type="submit" data-modal-hide="ban-kom-modals-{{$child->id}}" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">Inactive</button>
                                                    </form>
                                                    <button data-modal-hide="ban-kom-modals-{{$child->id}}" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 ">No, cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class="mt-4">
                                <p class="text-base">{{ $child->jawaban_konten }}</p>
                            </div>
                        </div>
                        @endif
                        @endforeach

                    </div>
                </div>
            </div>

            @endif
            @endforeach

            @else

            <div class="lg:w-[670px] w-full mx-auto px-4 rounded-xl mt-5 lg:bg-slate-100">
                <div class="flex justify-center items-center flex-col text-center gap-4 pb-10 bg-slate-100 lg:bg-none">
                    <img class="w-[300px] lg:w-[350px] object-cover" src="{{ asset('assets/img/no_answer.svg') }}" alt="Image">
                    <h1 class="font-bold font-title text-2xl md:text-3xl">{{$post->user->name}} menunggu bantuanmu</h1>
                    <p class="md:text-lg">Bantu {{$post->user->name}} agar dia bisa mendapatkan jawaban</p>
                    <div class="flex items-center justify-between">
                        <button data-modal-target="crud-modal-{{$post->id}}" data-modal-toggle="crud-modal-{{$post->id}}" class=" flex items-center py-1.5 px-3 bg-black text-white rounded-3xl font-bold gap-1 transition-all" type="button">
                            <img class="w-5" src="{{asset('assets/img/tambah.svg')}}" alt="">
                            <p>Tambahkan Jawaban</p>
                        </button>
                    </div>
                </div>
            </div>

            @endif

        </div>

        <div class="lg:w-[670px] w-full h-full bg-white border-y py-5 my-5 border-slate-200">
            <p class="p-3 mb-3 font-bold">Pertanyaan lainnya</p>
            <div class="flex justify-center flex-col">
                @foreach($posts as $item)
                <a href="/post/{{$item->slug}}" class="hover:bg-slate-200 px-3 py-2 text-blue-600 break-all">
                    {!!$item->judul_post!!}
                </a>
                @endforeach
            </div>
        </div>

    </div>

    <script>
        function toggleKomentarView(jawaban_id) {
            const komentarView = document.getElementById(`komentar_view-${jawaban_id}`);
            komentarView.classList.toggle('hidden');
            const button = document.querySelector(`[onclick="toggleKomentarView(${jawaban_id})"]`);
        }

    </script>

    @foreach($post->jawaban()->where('parent', 0)->get() as $jawaban)
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

    <script>
        ClassicEditor
            .create(document.querySelector('#editor'), {
                ckfinder: {
                    uploadUrl: "{{ url('/ckeditor/upload') }}?_token={{ csrf_token() }}"
                }
            })
            .catch(error => {
                console.error(error);
            });

    </script>


</x-app-layout>
