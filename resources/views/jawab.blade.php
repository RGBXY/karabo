<x-app-layout>
    <div class="flex items-start justify-center w-full bg-[#eaeaea] min-h-screen pt-20">
        <div class="flex flex-col gap-3 h-full w-[50%] items-center">
            @foreach ($jawab as $post)
            <div class="bg-white w-[100%] h-auto rounded-xl border-2 border-slate-300 p-3">
                <div class="flex items-center gap-2 mb-1">
                    @if($post->user->profile_image)
                    <img class="w-14 h-14 rounded-full border-2 border-white object-cover" src="{{ asset('storage/' . $post->user->profile_image) }}" alt="{{$post->kategori->nama_kategori}}">
                    @else
                    <img class="w-14 h-14 rounded-full border-2 border-white object-cover" src="{{ asset('assets/img/default-profile.png') }}" alt="{{$post->kategori->nama_kategori}}">
                    @endif
                    <div>
                        <p class="font-bold">{{$post->user->name}}</p>
                        <div class="flex gap-1">
                            <a href="/kategori/{{$post->kategori->slug}}">
                                <p class="text-sm">{{$post->kategori->nama_kategori}} •</p>
                            </a>
                            <p class=" text-sm">{{$post->created_at->diffForHumans()}}</p>
                        </div>
                    </div>
                </div>
                <a class=" text-xl font-bold" href="/post/{{$post->slug}}">{{$post->judul_post}}</a>
                @if($post->image)
                <div class="bg-neutral-700 ">
                    <img class="max-h-[500px] mx-auto object-contain" src="{{asset('storage/' . $post->image)}}" alt="{{$post->kategori->nama_kategori}}">
                </div>
                @else
                {{-- <img src="https://source.unsplash.com/1200x400?{{$post->kategori->nama_kategori}}" alt="{{$post->kategori->nama_kategori}}"> --}}
                @endif



                <!-- Modal toggle -->
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

                <!-- Modal toggle -->
                {{-- <div>
                    @foreach($post->jawaban as $jawaban)
                    @if($jawaban->user->profile_image)
                    <img class="w-14 h-14 rounded-full border-2 border-white object-cover" src="{{ asset('storage/' . $jawaban->user->profile_image) }}" alt="{{$post->kategori->nama_kategori}}">
                @else
                <img class="w-14 h-14 rounded-full border-2 border-white object-cover" src="{{ asset('assets/img/default-profile.png') }}" alt="{{$post->kategori->nama_kategori}}">
                @endif

                {{$jawaban->jawaban_konten}}
                @endforeach
            </div> --}}
        </div>
        @endforeach
    </div>
</x-app-layout>
