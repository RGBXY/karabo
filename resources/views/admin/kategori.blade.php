@extends('layouts.dashboard')

@section('content')

<div class="border- w-[75%] right-0 h-full">
    @if(session()->has('success'))
    <div id="alert-3" class="flex items-center p-4 text-green-800 rounded-lg bg-green-200 dark:bg-gray-800 dark:text-green-400" role="alert">
        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
        </svg>
        <span class="sr-only">Info</span>
        <div class="ms-3 text-sm font-medium">
            {{session('success')}}
        </div>
        <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-green-100 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-3" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
        </button>
    </div>
    @endif

    <div class="p-4 border-b border-black flex justify-between items-center">
        <h1 class="font-extrabold text-xl lg:hidden ">Kategori</h1>

        <form action="/dashboard/kategori" class="hidden md:w-[40%]">
            @if(request('kategori'))
            <input type="hidden" name="kategori" value="{{request('kategori')}}">
            @endif
            <div class="relative w-[100%] border border-black rounded-3xl">
                <input class="w-full rounded-3xl pl-6 py-2.5 focus:ring-0 text-sm border-none bg-white" type="text" placeholder="Cari Pertanyaan" name="search" value="{{request('search')}}">
                <button type="submit" class="absolute right-0 bg-slate-200 h-full border-l border-black w-14 rounded-e-3xl"><img class="w-5 mx-auto" src="{{asset('assets/img/search.svg')}}" alt=""></button>
            </div>
        </form>

        <!-- Crud modal toggle -->
        <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="border-2 flex items-center p-1 gap-0.5 border-black rounded-lg" type="button">
            <img width="20px" src="{{asset('assets/img/tambah-black.svg')}}" alt="">
            <span>add kategori</span>
        </button>

    </div>

    <div class="overflow-auto no-scrollbar z-10  overflow-x-auto h-[76vh]" style="">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nama Kategori
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Jumlah Post
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
                @foreach ($kategoris as $kategori)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 max-w-52 font-medium text-gray-900 dark:text-white">
                        <p>{{$kategori->nama_kategori}}</p>
                    </th>
                    <td class="px-6 py-4">
                        @foreach($jumlahPostKategori as $jpKategori)
                            @if($jpKategori->id == $kategori->id)
                                <p>{{ $jpKategori->post_count }}</p>
                            @endif
                        @endforeach
                    </td>
                    <td class="px-6 py-4">
                        {{$kategori->updated_at}}
                    </td>
                    <td class="px-6 py-4 flex items-center gap-2">

                        <!-- Edit modal toggle -->
                        <button data-modal-target="edit-modal-{{$kategori->id}}" data-modal-toggle="edit-modal-{{$kategori->id}}" class="bg-[#008EDA] p-2 rounded-lg" type="button">
                            <img class="w-5 h-5" src="{{asset('assets/img/edit.svg')}}" alt="">
                        </button>

                        <!-- Delete modal toggle -->
                        <button data-modal-target="popup-modal-{{$kategori->id}}" data-modal-toggle="popup-modal-{{$kategori->id}}" class="bg-red-600 p-2 rounded-lg" type="button">
                            <img class="w-5 h-5" src="{{asset('assets/img/delete.svg')}}" alt="">
                        </button>

                        {{-- Modal Delete --}}
                        <div id="popup-modal-{{$kategori->id}}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-md max-h-full">
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal-{{$kategori->id}}">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                    <div class="p-4 md:p-5 text-center">
                                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                        <h3 class="mb-5 text-lg font-normal text-black">Yakin mau <span class="text-red">menghapus</span> kategori ini?</h3>
                                        <div class="flex justify-center items-center">
                                            <form method="post" action="{{route('kategori.destroy', ['kategori' => $kategori])}}">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">Delete</button>
                                            </form>
                                            <button data-modal-hide="popup-modal-{{$kategori->id}}" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Tidak, Batalkan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Modal Update --}}
                        <div id="edit-modal-{{$kategori->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto fixed overflow-x-hiddop-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-[500px] max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <!-- Modal header -->
                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                            Edit Kategori
                                        </h3>
                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="edit-modal-{{$kategori->id}}">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <form action="{{route('kategori.update', ['kategori' => $kategori])}}" method="post">
                                        @csrf
                                        @method('put')
                                        <div class="flex flex-col gap-3 p-5">
                                            <label for="">Kategori</label>
                                            <input class="text-gray-900 bg-gray-50 rounded-lg focus:shadow border-gray-300 focus:ring-0 focus:border-slate-300" type="text" name="nama_kategori" value="{{$kategori->nama_kategori}}">
                                            <button type="submit" class="bg-slate-900 p-2 text-white rounded">Update</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>

                        {{-- Modal Create --}}
                        <div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full lg:w-[30rem] md:max-w-[80rem] max-h-full z-50">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <!-- Modal header -->
                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                            Kategori
                                        </h3>
                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <form class="p-4 md:p-5" action="{{route('kategori.store')}}" method="post">
                                        @csrf
                                        @method('post')
                                        <label for="">Kategori</label>
                                        <div class=" gap-4 mb-4 ">
                                            <input class="w-full text-gray-900 bg-gray-50 rounded-lg focus:shadow border-gray-300 focus:ring-0 focus:border-slate-300" type="text" name="nama_kategori">
                                        </div>
                                        <button type="submit" class="text-white w-full bg-slate-800 hover:bg-slate-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                            <span>Buat</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{$kategoris->links()}}
    </div>

</div>



@endsection
