<x-app-layout>

    <div class="mx-10 h-full pt-20">
        <h1 class="text-2xl font-bold border-b-2 border-black pb-3 ">Pilih topik yang sesuai dengan mu 🤩</h1>
        @foreach ($kategoris as $kategori)
        <div class="py-5">
            <div class="flex items-center justify-between">
                <p class="py-3 font-bold text-xl">{{$kategori->nama_kategori}}</p>
                <a class="flex items-center gap-1" href="/kategori/{{$kategori->slug}}">
                    <p class="underline">selengkapnya </p>
                    <img src="{{asset('assets/img/arrow.svg')}}" alt="">
                </a>
            </div>
            <div class="flex flex-wrap gap-5">
                @foreach ($kategori->post->shuffle()->take(3) as $post)
                <div class="w-[380px] min-h-[180px] bg-white shadow-md border border-slate-200 p-4 flex flex-col justify-between rounded-2xl">
                    <div class="flex items-center gap-2">
                        @if($post->user->profile_image)
                        <img class="w-12 h-12 rounded-full border-2 border-white object-cover" src="{{ asset('storage/' . $post->user->profile_image) }}" alt="{{$post->kategori->nama_kategori}}">
                        @else
                        <img class="w-12 h-12 rounded-full border-2 border-white object-cover" src="{{ asset('assets/img/default-profile.png') }}" alt="{{$post->kategori->nama_kategori}}">
                        @endif
                        <div>
                            <h1>{{$post->user->name}}</h1>
                            <h1 class="text-sm">{{$post->created_at->diffForHumans( )}}</h1>
                        </div>
                    </div>
                    <a href="/post/{{$post->slug}}" class="text-xl font-bold hover:underline">{{$post->judul_post}}</a>
                    <div class="flex items-center justify-between mt-3">
                        <button data-modal-target="crud-modal-{{$post->id}}" data-modal-toggle="crud-modal-{{$post->id}}" class=" block text-black font-extrabold border-2 border-black hover:bg-slate-300 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-3xl text-sm px-4 py-1 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition-all" type="button">
                            Jawab
                        </button>
                        <div class="flex gap-3 items-center">
                            <p class="border-2 border-black py-1 text-sm px-4 rounded-3xl">Jawaban {{$jawabanPerPost[$post->id]}}</p>
                            <button class="hover:bg-pink-100 rounded-lg p-1">❤️ <span>0</span></button>
                        </div>
                    </div>

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
                                            <textarea name="jawaban_konten" id="jawaban" rows="6" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Jawaban Anda"></textarea>
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
                @endforeach
            </div>
        </div>
        @endforeach
    </div>

    {{-- @foreach ($kategoris as $kategori)
    <a class="bg-cyan-800 p-3 w-full hover:bg-cyan-900 transition-all" href="/kategori/{{$kategori->slug}}">{{$kategori->nama_kategori}}</a>
    @endforeach --}}

</x-app-layout>
