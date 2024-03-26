<x-app-layout>
    <div class="pt-20 rounded-xl flex justify-center gap-5">
        <div class="w-[50%]">
            <div class="bg-white border-2 border-slate-200 rounded-xl p-4">
                <div class="flex gap-3 items-center">
                    @if($post->user->profile_image)
                    <img class="w-11 h-11 rounded-full object-cover" src="{{ asset('storage/' . $post->user->profile_image) }}" alt="{{$post->kategori->nama_kategori}}">
                    @else
                    <img class="w-11 h-11 rounded-full object-cover" src="{{ asset('assets/img/default-profile.png') }}" alt="{{$post->kategori->nama_kategori}}">
                    @endif
                    <div>
                        <p class="font-bold">{{$post->user->name}}</p>
                        <div class="flex items-center gap-1">
                            <p class="text-sm">{{$post->created_at->diffForHumans()}}</p>
                            <a href="/kategori/{{$post->kategori->slug}}"><span class="text-sm">• {{$post->kategori->nama_kategori}}</span></a>
                        </div>
                    </div>
                </div>
                <h1 class="my-4 text-lg">{{$post->judul_post}}</h1>

                @if($post->image)
                <div class="bg-neutral-700 rounded-lg overflow-hidden mb-4">
                    <img class="max-h-[500px] mx-auto object-contain" src="{{asset('storage/' . $post->image)}}" alt="{{$post->kategori->nama_kategori}}">
                </div>
                @endif

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

                <!-- Main modal -->
                <div id="crud-modal-{{$post->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-md max-h-full">
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
                                <div class="grid gap-4 mb-4 grid-cols-2">
                                    <div class="col-span-2">
                                        <label for="jawaban" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jawaban</label>
                                        <textarea name="jawaban_konten" id="editor" rows="6" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Jawaban Anda"></textarea>
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
            </div>

            @if($post->hasAnswer())
            @foreach($post->jawaban()->where('parent', 0)->orderBy('created_at', 'desc')->get() as $jawaban)
            <?php $jawaban_konten = html_entity_decode(strip_tags($jawaban->jawaban_konten));?>
            <div class="bg-white border-2 border-slate-200 rounded-xl mt-5">
                <div class="border-b-2 p-4">
                    <p class="font-bold text-xl">Jawaban 📖</p>
                </div>
                <div class="p-4">
                    <div class="flex gap-3">
                        <img class="w-11 h-11 rounded-full object-cover" src="{{asset('storage/' . $jawaban->user->profile_image)}}" alt="halo">
                        <div>
                            <p class="font-bold">{{$jawaban->user->name}}</p>
                            <p class="text-sm">{{$jawaban->created_at->diffForHumans()}}</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <p class="text-xl">{{$jawaban_konten}}</p>
                    </div>
                </div>
                <form action="{{route('jawaban_store')}}" method="post">
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <input type="hidden" name="parent" value="{{ $jawaban->id }}">
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="jawaban" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jawaban</label>
                            <textarea name="jawaban_konten" id="editor" rows="6" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Jawaban Anda"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                        </svg>
                        Kirim
                    </button>
                </form>
                @foreach($jawaban->childs as $child)
                <div class="p-4 ml-4 border-l-2 border-gray-300">
                    <div class="flex gap-3">
                        <img class="w-11 h-11 rounded-full object-cover" src="{{ asset('storage/' . $child->user->profile_image) }}" alt="halo">
                        <div>
                            <p class="font-bold">{{ $child->user->name }}</p>
                            <p class="text-sm">{{ $child->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <p class="text-xl">{{ $child->jawaban_konten }}</p>
                    </div>
                </div>
            @endforeach
            </div>
            @endforeach

            @else
            <div>
                gak ada jawaban
            </div>
            @endif

        </div>

        <div class="w-[20%] h-full bg-slate-400">
            user
        </div>
    </div>
</x-app-layout>
