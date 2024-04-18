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
                <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="py-2 px-3 gap-0.5 bg-[#1a8917] rounded-3xl" type="button">
                    <span class="text-white font-title text-sm">Tambah Pertanyaan</span>
                </button>
            </div>
            <div class="flex mb-9 border-b py-10 relative">
                <a class="absolute pb-4 font-bold border-b border-black" href="{{route('dashboard')}}">Pertanyaan</a>
                <a class="absolute left-28" href="{{route('dashboard_jawaban')}}">Jawaban</a>
            </div>
            @foreach($posts->reverse() as $post)
            <div class="pb-7 mt-5 border-b">
                <h1 class="font-title font-bold text-lg">{!!$post->judul_post!!}</h1>
                <p class="text-slate-600 mb-1">{{$post->kategori->nama_kategori}}</p>
                <div class="flex items-center gap-3">
                    <p class="text-sm">{{$post->created_at->format('d M Y')}}</p>
                    <button id="dropdownDefaultButton-{{$post->id}}" data-dropdown-toggle="dropdown-{{$post->id}}" class="text-white" type="button">
                        <span class="text-black">•••</span>
                    </button>
                </div>
            </div>


            <!-- Dropdown menu -->
            <div id="dropdown-{{$post->id}}" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-lg border w-44 dark:bg-gray-700">
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton-{{$post->id}}">
                    <li>
                        <a href="/post/{{$post->slug}}" class="w-full text-start font-bold px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 " type="button">
                            View
                        </a>
                    </li>
                    <li>
                        <button data-modal-target="edit-modal-{{$post->id}}" data-modal-toggle="edit-modal-{{$post->id}}" class="w-full text-start font-bold px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 " type="button">
                            Edit
                        </button>
                    </li>
                    <li>
                        <button data-modal-target="popup-modal-{{$post->id}}" data-modal-toggle="popup-modal-{{$post->id}}" class="w-full text-start text-red-500 font-bold px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600" type="button">
                            Delete
                        </button>
                    </li>
                </ul>
            </div>

            <!-- Modal Delete -->
            <div id="popup-modal-{{$post->id}}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal-{{$post->id}}">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                        <div class="p-4 md:p-5 text-center">
                            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this product?</h3>
                            <div class="flex w-full justify-center">
                                <form method="post" action="{{ route('post.destroy', ['post' => $post]) }}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" data-modal-hide="popup-modal-{{$post->id}}" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">Delete</button>
                                </form>
                                <button data-modal-hide="popup-modal-{{$post->id}}" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Edit -->
            <div id="edit-modal-{{$post->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto fixed overflow-x-hidden top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 max-w-[700px] max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                Buat Pertanyaan
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="edit-modal-{{$post->id}}">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <form action="{{route('post.update', ['post' => $post])}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="flex flex-col gap-5 p-5">
                                <div>
                                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pertanyaan</label>
                                    <textarea id="editor4" name="judul_post" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg focus:shadow border-gray-300 focus:ring-0 focus:border-slate-300" placeholder="Tulis pertanyaan">{!!$post->judul_post!!}</textarea>
                                </div>
                                <div class="flex items-end gap-5">
                                    <div class="">
                                        <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                                        <select id="category" name="kategori_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                            @foreach ($kategoris as $kategori)
                                            <option value="{{$kategori->id}}" selected>{{$kategori->nama_kategori}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <input class="rounded-xl border" type="file" name="image">
                                    <img width="30px" src="{{asset('storage/' . $post->image)}}" alt="{{$post->kategori->nama_kategori}}">
                                </div>
                                <button type="submit" class="text-white inline items-center bg-slate-800 hover:bg-slate-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                    Update
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            @endforeach
            <!-- Modal Create -->
            @include('components.create-modal')

        </div>
        <div class="w-[350px] h-screen sticky top-0 pt-20 px-10 bg-white border-l border-slate-200 hidden lg:block">
            @include('components.side-content')
        </div>
    </div>

    <script>
        ClassicEditor
            .create(document.querySelector('#editor2'), {
                ckfinder: {
                    uploadUrl: "{{ isset($post) ? route('ckeditor.upload', ['post' => $post->slug]) : route('ckeditor.upload') }}"
                    , headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }
            })
            .catch(error => {
                console.error(error);
            });

    </script>
</x-app-layout>
