<x-app-layout>
    <div class="pt-20 rounded-xl flex flex-col items-center justify-center gap-5 w-full">

        <div class="w-[700px] pt-4">
            <div class="bg-white rounded-xl p-4">
                <h1 class="text-4xl font-[900] font-title">{!!$post->judul_post!!}</h1>
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
                            <a href="/kategori/{{$post->kategori->slug}}"><span class="text-sm">• {{$post->kategori->nama_kategori}}</span></a>
                        </div>
                    </div>

                </div>

                <div class="mb-10 border-t border-b border-slate-200 py-3 px-1">
                    @if($post->hasAnswer())
                    <div class="flex items-center gap-3">
                        <div class="py-2 px-3 bg-black text-sm rounded-3xl font-extrabold inline-block">
                            <p class="text-white">Lihat Jawaban <span class="bg-white text-black py-0.5 rounded-full px-2">{{$jawabanPerPost[$post->id]}}</span></p>
                        </div>
                        <div class="flex items-center justify-between">
                            <button data-modal-target="crud-modal-{{$post->id}}" data-modal-toggle="crud-modal-{{$post->id}}" class=" flex items-center py-1.5 px-3 bg-black text-white rounded-3xl font-bold gap-1 transition-all" type="button">
                                <img class="w-5" src="{{asset('assets/img/tambah.svg')}}" alt="">
                                <p>Tambahkan Jawaban</p>
                            </button>
                        </div>
                    </div>

                    @else
                    <div class="flex items-center justify-between">
                        <button data-modal-target="crud-modal-{{$post->id}}" data-modal-toggle="crud-modal-{{$post->id}}" class=" flex items-center py-1.5 px-3 bg-black text-white rounded-3xl font-bold gap-1 transition-all" type="button">
                            <img class="w-5" src="{{asset('assets/img/tambah.svg')}}" alt="">
                            <p>Tambahkan Jawaban</p>
                        </button>
                    </div>
                    @endif
                </div>

                @if($post->image)
                <div class="bg-neutral-700 rounded-lg overflow-hidden mb-4">
                    <img class="max-h-[500px] mx-auto object-contain" src="{{asset('storage/' . $post->image)}}" alt="{{$post->kategori->nama_kategori}}">
                </div>
                @endif

                <!-- Main modal -->
                <div id="crud-modal-{{$post->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-[50rem] max-w-[80rem] max-h-full z-50">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <!-- Modal header -->
                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                    Jawaban
                                </h3>
                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal-{{$post->id}}">
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
                                <div class=" gap-4 mb-4 ">
                                    <div class="min-h-52">
                                        <label for="jawaban" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jawaban</label>
                                        <textarea name="jawaban_konten" id="editor" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Jawaban Anda"></textarea>
                                    </div>
                                </div>
                                <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    Kirim
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                @include('components.create-modal')

            </div>

            @if($post->hasAnswer())
            <div class="px-4 py-2 text-lg font-bold">Jawaban Terkait ({{$jawabanPerPost[$post->id]}})</div>
            @foreach($post->jawaban()->where('parent', 0)->orderBy('created_at', 'desc')->get() as $jawaban)
            <div id="jawaban" class="bg-white border border-slate-200 mt-5 w-[670px] mx-auto">
                <div class="border-b p-4">
                    <p class="font-bold text-xl font-title">Jawaban 📖</p>
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
                        <form action="{{route('jawaban_store')}}" method="post" class="pt-4 pb-2 border-t ">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <input type="hidden" name="parent" value="{{ $jawaban->id }}">
                            <div class="flex justify-between items-center">
                                <textarea name="jawaban_konten" id="editor" class="p-3 w-[87%] min-h-4 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-0 focus:border-slate-300" placeholder="Komen"></textarea>
                                <button type="submit" class="bg-green-500 py-2 px-4 max-h-12 text-white rounded-3xl">
                                    Kirim
                                </button>
                            </div>
                        </form>

                        @foreach($jawaban->childs as $child)
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
                            </div>
                            <div class="mt-4">
                                <p class="text-base">{{ $child->jawaban_konten }}</p>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
            @endforeach

            @else

            <div class="flex justify-center items-center flex-col w-[670px] mx-auto gap-4 pb-10 bg-slate-100 rounded-xl mt-5">
                <img class="w-[350px] object-cover" src="{{ asset('assets/img/no_answer.svg') }}" alt="{{$post->kategori->nama_kategori}}">
                <h1 class="font-bold font-title text-3xl">{{$post->user->name}} menunggu bantuanmu</h1>
                <p class="text-lg">Bantu {{$post->user->name}} agar dia bisa mendapat jawaban</p>
                <div class="flex items-center justify-between">
                    <button data-modal-target="crud-modal-{{$post->id}}" data-modal-toggle="crud-modal-{{$post->id}}" class=" flex items-center py-1.5 px-3 bg-black text-white rounded-3xl font-bold gap-1 transition-all" type="button">
                        <img class="w-5" src="{{asset('assets/img/tambah.svg')}}" alt="">
                        <p>Tambahkan Jawaban</p>
                    </button>
                </div>
            </div>

            @endif

        </div>

        <div class="w-[670px] h-full bg-white border-y py-5 my-5 border-slate-200">
            <p class="p-3 mb-3 font-bold">Pertanyaan lainnya</p>
            <div class="flex justify-center flex-col">
                @foreach($posts as $item)
                <a href="#" class="hover:bg-slate-200 px-3 py-2 text-blue-600">
                    {!!$item->judul_post!!}
                </a>
                @endforeach
                <a href="#" class="px-3 py-3 text-slate-500">Tambah pertanyaan</a>
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

    <script>
        ClassicEditor
            .create(document.querySelector('#editor'), {
                ckfinder: {
                    uploadUrl: "<?php echo route('ckeditor.upload' , ['post' => $post->slug], ['_token' => csrf_token()]); ?>"
                , }
            })
            .catch(error => {
                console.error(error);
            });

    </script>

</x-app-layout>
