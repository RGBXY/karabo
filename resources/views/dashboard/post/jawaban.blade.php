<x-app-layout>
    <div>
        @if(session()->has('success'))
        <div>
            {{session('success')}}
        </div>
        @endif
    </div>

    <div class="lg:w-[1200px] h-full flex justify-evenly mx-auto">
        <div class="w-[700px] pt-28 px-6 h-full">
            <div class="flex justify-between items-center w-full">
                <h1 class="font-extrabold font-title text-2xl md:text-4xl">Jawaban</h1>
                <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="py-2 px-3 gap-0.5 bg-[#1a8917] rounded-3xl" type="button">
                    <span class="text-white font-title text-sm">Tambah Pertanyaan</span>
                </button>
            </div>
            <div class="flex mb-9 border-b py-10 relative">
                <a class="absolute" href="{{route('dashboard')}}">Pertanyaan</a>
                <a class="absolute left-28 font-bold border-b border-black pb-4" href="{{route('dashboard_jawaban')}}">Jawaban</a>
            </div>
            @foreach($jawabans->reverse() as $jawaban)
            <div class="pb-7 mt-5 border-b">
                <h1 class="font-title font-bold text-lg">{!!$jawaban->jawaban_konten!!}</h1>
                <div class="flex items-center gap-3">
                    <p class="text-sm">{{$jawaban->created_at->format('d M Y')}}</p>
                    <button id="dropdownDefaultButton-{{$jawaban->id}}" data-dropdown-toggle="dropdown-{{$jawaban->id}}" class="text-white" type="button">
                        <span class="text-black">•••</span>
                    </button>
                </div>
            </div>


            <!-- Dropdown menu -->
            <div id="dropdown-{{$jawaban->id}}" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-lg w-44 dark:bg-gray-700">
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton-{{$jawaban->id}}">
                    <li>
                        <button data-modal-target="edit-modal-{{$jawaban->id}}" data-modal-toggle="edit-modal-{{$jawaban->id}}" class="w-full text-start font-bold px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 " type="button">
                            Edit
                        </button>
                    </li>
                    <li>
                        <button data-modal-target="popup-modal-{{$jawaban->id}}" data-modal-toggle="popup-modal-{{$jawaban->id}}" class="w-full text-start text-red-500 font-bold px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600" type="button">
                            Delete
                        </button>
                    </li>
                </ul>
            </div>

            <!-- Modal Delete -->
            <div id="popup-modal-{{$jawaban->id}}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal-{{$jawaban->id}}">
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
                            <div class="flex justify-center w-full">
                                <form method="post" action="{{ route('jawaban.destroy', ['jawaban' => $jawaban]) }}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" data-modal-hide="popup-modal-{{$jawaban->id}}" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">Delete</button>
                                </form>
                                <button data-modal-hide="popup-modal-{{$jawaban->id}}" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Edit Jawaban -->
            <div id="edit-modal-{{$jawaban->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto fixed overflow-x-hiddop-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 max-w-[700px] max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                Edit Pertanyaan
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="edit-modal-{{$jawaban->id}}">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <form action="{{route('jawaban.update', ['jawaban' => $jawaban])}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="flex flex-col gap-5 p-5">
                                <div>
                                    <label for="editor-{{$jawaban->id}}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jawaban</label>
                                    <textarea id="editor-{{$jawaban->id}}" name="jawaban_konten" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{!!$jawaban->jawaban_konten!!}</textarea>
                                </div>
                                <button type="submit" class="text-white inline items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
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

    @foreach ($jawabans as $jawaban)
    <script>
        ClassicEditor
            .create(document.querySelector('#editor-{{$jawaban->id}}'), {
                ckfinder: {
                    uploadUrl: "{{ route('ckeditor.upload') }}"
                    , headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }
            })
            .catch(error => {
                console.error(error);
            });

    </script>
    @endforeach

</x-app-layout>
