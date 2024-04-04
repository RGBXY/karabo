@extends('layouts.dashboard')

@section('content')
<div>
    @if(session()->has('success'))
    <div>
        {{session('success')}}
    </div>
    @endif
</div>

<div class="border- w-[75%] right-0 h-full">
    <div class="p-4 border-b border-black flex justify-between items-center">
        <h1 class="font-extrabold text-xl">Post</h1>
        <div class="relative w-[40%]">
            <input class="w-full rounded-xl pl-10 text-sm" type="text" placeholder="Cari Pertanyaan">
            <button class="absolute left-3 top-2.5"><img class="w-4" src="{{asset('assets/img/search.svg')}}" alt=""></button>
        </div>

        <!-- Crud modal toggle -->
        <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="border-2 flex items-center p-1 gap-0.5 border-black rounded-lg" type="button">
            <img width="20px" src="{{asset('assets/img/tambah-black.svg')}}" alt="">
            <span>add post</span>
        </button>

        <!-- Modal Crud -->
        <div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto fixed overflow-x-hiddop-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 max-w-[700px] max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Buat Pertanyaan
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <form action="{{route('post.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="flex flex-col gap-5 p-5">
                            <div class="">
                                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pertanyaan</label>
                                <textarea id="editor2" name="judul_post" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Tulis pertanyaan"></textarea>
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
                                <input type="file" name="image">
                            </div>
                            <button type="submit" class="text-white inline items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Buat pertanyaan
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>

    <div class="overflow-auto no-scrollbar z-10  overflow-x-auto h-[76vh]" style="">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Pertanyaan
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Kategori
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Waktu
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts->reverse() as $post)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 max-w-52 font-medium text-gray-900 dark:text-white">
                        {!!$post->judul_post!!}
                    </th>
                    <td class="px-6 py-4">
                        {{$post->kategori->nama_kategori}}
                    </td>
                    <td class="px-6 py-4">
                        {{$post->updated_at}}
                    </td>
                    <td class="px-6 py-4 flex items-center gap-2">

                        <!-- Edit modal toggle -->
                        <button data-modal-target="edit-modal-{{$post->id}}" data-modal-toggle="edit-modal-{{$post->id}}" class="bg-[#008EDA] p-2 rounded-lg" type="button">
                            <img class="w-5 h-5" src="{{asset('assets/img/edit.svg')}}" alt="">
                        </button>
                        <!-- Deelete modal toggle -->
                        <button data-modal-target="popup-modal-{{$post->id}}" data-modal-toggle="popup-modal-{{$post->id}}" class="bg-red-600 p-2 rounded-lg" type="button">
                            <img class="w-5 h-5" src="{{asset('assets/img/delete.svg')}}" alt="">
                        </button>

                        {{-- Modal Delete --}}
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

                        {{-- Modal Update --}}
                        <div id="edit-modal-{{$post->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto fixed overflow-x-hiddop-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 max-w-[700px] max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <!-- Modal header -->
                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                            Buat Pertanyaan {{$post->id}}
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
                                                <label for="editor-{{$post->id}}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pertanyaan</label>
                                                <textarea id="editor-{{$post->id}}" name="judul_post" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{!!$post->judul_post!!}</textarea>
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
                                                <input type="file" name="image">
                                                <img width="30px" src="{{asset('storage/' . $post->image)}}" alt="{{$post->kategori->nama_kategori}}">
                                            </div>
                                            <button type="submit" class="text-white inline items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                Update
                                            </button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
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

@foreach ($posts as $post)
<script>
    ClassicEditor
        .create(document.querySelector('#editor-{{$post->id}}'), {
            ckfinder: {
                uploadUrl: "{{ route('ckeditor.upload', ['post' => $post->slug]) }}"
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

@endsection
