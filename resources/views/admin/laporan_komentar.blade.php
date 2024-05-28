@extends('layouts.dashboard')

@section('content')

<div class="w-full lg:w-[75%] h-full relative">
    @if(session()->has('success'))
    <div id="alert-3" class="flex items-center p-4 fixed left-0 right-0 z-50 text-green-800 rounded-lg bg-green-50" role="alert">
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

    <div class="p-4 border-b border-black ">
        <div class="flex justify-between items-center">
            <h1 class="font-extrabold text-xl hidden lg:block">Komentar</h1>
            <button id="showButton">
                <img class="lg:hidden" src="{{asset('assets/img/hamburger.svg')}}" alt="">
            </button>

            {{-- <form action="/dashboard/laporan" class="hidden md:block md:w-[40%]">
                @if(request('kategori'))
                <input type="hidden" name="kategori" value="{{request('kategori')}}">
            @endif
            <div class="relative w-[100%] border border-black rounded-3xl">
                <input class="w-full rounded-3xl pl-6 py-2.5 focus:ring-0 text-sm border-none bg-white" type="text" placeholder="Cari Pertanyaan" name="search" value="{{request('search')}}">
                <button type="submit" class="absolute right-0 bg-slate-200 h-full border-l border-black w-14 rounded-e-3xl"><img class="w-5 mx-auto" src="{{asset('assets/img/search.svg')}}" alt=""></button>
            </div>
            </form> --}}


            <!-- Crud modal toggle -->
            <div class="flex gap-3">
                {{-- <button class="md:hidden" onclick="toggleComponent()">
                    <img id="searchToggle" class="w-6" src="{{asset('assets/img/search.svg')}}" alt="">
                </button> --}}

                <select class="rounded-lg border-2 border-slate-300 shadow-md focus:ring-0 border-none" name="forma" onchange="location = this.value;">
                    <option value="/dashboard/laporan">Pertanyaan</option>
                    <option value="/dashboard/laporan/jawaban">Jawaban</option>
                    <option selected value="/dashboard/laporan/komentar">Komentar</option>
                </select>
            </div>


        </div>

        {{-- <div id="searchBar" class="mt-5 px-5 pb-3 md:hidden" style="display: none">
            <form action="/dashboard/admin" class="md:w-[40%] lg:w-[30%] md:block">
                @if(request('kategori'))
                <input type="hidden" name="kategori" value="{{request('kategori')}}">
        @endif
        <div class="relative w-[100%] border border-black rounded-3xl md:hidden">
            <input class="w-full rounded-3xl pl-6 py-2.5 focus:ring-0 text-sm border-none bg-white" type="text" placeholder="Cari Pertanyaan" name="search" value="{{request('search')}}">
            <button type="submit" class="absolute right-0 bg-slate-200 h-full border-l border-black w-14 rounded-e-3xl"><img class="w-5 mx-auto" src="{{asset('assets/img/search.svg')}}" alt=""></button>
        </div>
        </form>
    </div> --}}

</div>

<div class="overflow-auto no-scrollbar z-10  overflow-x-auto h-[76vh]" style="">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 table-fixed">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Nama
                </th>
                <th scope="col" class="px-6 py-3">
                    Jawaban
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
            @foreach ($jawabans->reverse() as $jawaban)
            <tr class="bg-white border-b">
                <th scope="row" class="px-6 py-4 max-w-52 font-medium text-gray-900">
                    {!!$jawaban->user->name!!}
                </th>
                <th scope="row" class="px-6 py-4 max-w-52 font-medium text-gray-900">
                    {!! Illuminate\Support\Str::words($jawaban->jawaban_konten, 10, '...') !!}
                </th>
                <td class="px-6 py-4">
                    {{ \Carbon\Carbon::parse($jawaban->created_at)->translatedFormat('H:i, d F Y') }}
                </td>
                <td class="py-4 flex items-center gap-2">
                    <!-- Delete modal toggle -->
                    @if($jawaban->status == 1)
                    <button data-modal-target="popup-modals-{{$jawaban->id}}" data-modal-toggle="popup-modals-{{$jawaban->id}}" class="bg-blue-500 p-2 rounded-lg" type="button">
                        <img class="w-5 h-5" src="{{asset('assets/img/unlock.svg')}}" alt="">
                    </button>
                    @else
                    <button data-modal-target="popup-modal-{{$jawaban->id}}" data-modal-toggle="popup-modal-{{$jawaban->id}}" class="bg-red-600 p-2 rounded-lg" type="button">
                        <img class="w-5 h-5" src="{{asset('assets/img/lock.svg')}}" alt="">
                    </button>
                    @endif

                    <button data-modal-target="delete-report-{{$jawaban->id}}" data-modal-toggle="delete-report-{{$jawaban->id}}" class="bg-red-600 p-2 rounded-lg" type="button">
                        <img class="w-5 h-5" src="{{asset('assets/img/delete.svg')}}" alt="">
                    </button>

                    <a href="/post/{{$jawaban->post->slug}}" class="bg-green-500 p-2 rounded-lg">
                        <img class="w-5 h-5" src="{{asset('assets/img/eye.svg')}}" alt="">
                    </a>

                    {{-- Modal Suspend --}}
                    <div id="popup-modal-{{$jawaban->id}}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-md max-h-full">
                            <div class="relative bg-white rounded-lg shadow">
                                <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="popup-modal-{{$jawaban->id}}">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                                <div class="p-4 md:p-5 text-center">
                                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                    <h3 class="mb-5 text-lg font-normal text-black ">Yakin mau <span class="text-red-500">mengnonaktifkan</span> jawaban ini?</h3>
                                    <div class="flex justify-center">
                                        <form action="{{ route('ban.jawaban', ['id' => $jawaban->id]) }}" method="POST">
                                            @csrf
                                            @method('POST')
                                            <button type="submit" data-modal-hide="popup-modal-{{$jawaban->id}}" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">Suspend</button>
                                        </form>
                                        <button data-modal-hide="popup-modal-{{$jawaban->id}}" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:z-10 focus:ring-4 focus:ring-gray-100 ">Tidak, Batalkan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Modal Aktif --}}
                    <div id="popup-modals-{{$jawaban->id}}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-md max-h-full">
                            <div class="relative bg-white rounded-lg shadow">
                                <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="popup-modals-{{$jawaban->id}}">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                                <div class="p-4 md:p-5 text-center">
                                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                    <h3 class="mb-5 text-lg font-normal text-black">Yakin mau mengaktifkan jawaban ini?</h3>
                                    <div class="flex justify-center">
                                        <form action="{{ route('batal.ban.jawaban', ['id' => $jawaban->id]) }}" method="POST">
                                            @csrf
                                            @method('POST')
                                            <button type="submit" data-modal-hide="popup-modals-{{$jawaban->id}}" class="text-white bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">Aktifkan</button>
                                        </form>
                                        <button data-modal-hide="popup-modals-{{$jawaban->id}}" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:z-10 focus:ring-4 focus:ring-gray-100">Tidak, Batalkan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="delete-report-{{$jawaban->id}}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-md max-h-full">
                            <div class="relative bg-white rounded-lg shadow">
                                <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="delete-report-{{$jawaban->id}}">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                                <div class="p-4 md:p-5 text-center">
                                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                    <h3 class="mb-5 text-lg font-normal text-black">Yakin mau menghapus laporan ini?</h3>
                                    <div class="flex justify-center">
                                        <form action="{{ route('batal.report.jawaban', ['id' => $jawaban->id]) }}" method="POST">
                                            @csrf
                                            @method('POST')
                                            <button type="submit" data-modal-hide="delete-report-{{$jawaban->id}}" class="text-white bg-red-500 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">Hapus</button>
                                        </form>
                                        <button data-modal-hide="delete-report-{{$jawaban->id}}" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:z-10 focus:ring-4 focus:ring-gray-100">Tidak, Batalkan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{$jawabans->links()}}
</div>

</div>



@endsection
