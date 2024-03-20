@extends('layouts.dashboard')

@section('content')
<div>
    @if(session()->has('success'))
    <div>
        {{session('success')}}
    </div>
    @endif
</div>

<div class="h-full">
    <div class="w-full h-20 bg-slate-500 fixed flex justify-between items-center px-5">
        <a href="{{route('home')}}" class="flex items-center gap-2"><img width="19px" src="{{asset('assets/img/back.svg')}}" alt=""><span class="font-bold text-lg">Home</span></a>
        <h1 class="font-bold text-2xl">Dashboard</h1>
        <p class="text-lg font-bold">Userss ?</p>
    </div>

    <div class="flex pt-20 h-full">
        <div class="w-[25%] h-full bg-cyan-100 fixed">
            <h1 class="p-4 bg-cyan-700 font-extrabold text-xl">Content</h1>
            <div class="mt-2 px-2">
                <a href="" class="flex justify-between px-2 py-3 rounded-lg bg-slate-500"><span class="font-bold text-slate-200">Post</span><img src="{{asset('assets/img/arrow.svg')}}" alt=""></a>
            </div>
            <div class="mt-2 px-2">
                <a href="" class="flex justify-between px-2 py-3 rounded-lg"><span class="font-bold ">Jawaban</span><img src="{{asset('assets/img/arrow.svg')}}" alt=""></a>
            </div>
        </div>
        <div class="bg-blue-800 w-[75%] fixed right-0 h-full">
            <div class="p-4 bg-red-600 flex justify-between items-center">
                <h1 class="font-extrabold text-xl">Post</h1>
                <div class="relative w-[40%]">
                    <input class="w-full rounded-xl pl-10 text-sm" type="text" placeholder="Cari Pertanyaan">
                    <button class="absolute left-3 top-2.5"><img class="w-4" src="{{asset('assets/img/search.svg')}}" alt=""></button>
                </div>
                <a href="{{route('post.create')}}" class="border-2 flex items-center p-1 gap-0.5 border-black rounded-lg">
                    <img width="20px" src="{{asset('assets/img/tambah.svg')}}" alt="">
                    <span>add post</span>
                </a>
            </div>
            <div class="overflow-auto no-scrollbar h-[80vh]" style="">
                <div class="p-4">
                    <table class="border-2 border-red-600 w-full">
                        <thead>
                            <tr>
                                <th class="py-3">Gambar</th>
                                <th class="py-3">Pertanyaan</th>
                                <th class="py-3">Kategori</th>
                                <th class="py-3">Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                            <tr>
                                <th class="w-[200px]">
                                    @if($post->image)
                                    <img width="200px" class="mb-3" src="{{asset('storage/' . $post->image)}}" alt="{{$post->kategori->nama_kategori}}">
                                    @else
                                    <img width="200px" class="mb-3" src="https://source.unsplash.com/1200x400?{{$post->kategori->nama_kategori}}" alt="{{$post->kategori->nama_kategori}}">
                                    @endif
                                </th>
                                <th>
                                    <h1>{{$post->judul_post}}</h1>
                                </th>
                                <th>
                                    <p>{{$post->kategori->nama_kategori}}</p>
                                </th>
                                <th>
                                    <a href="{{route('post.edit', ['post' => $post])}}">edit</a>
                                    <form method="post" action="{{route('post.destroy', ['post' => $post])}}">
                                        @csrf
                                        @method('delete')
                                        <input type="submit" value="Delete">
                                    </form>
                                </th>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- @foreach ($posts as $post)
                    <div class="mb-4 bg-red-500 min-h-10 p-3 flex">
                        @if($post->image)
                        <img width="250px" src="{{asset('storage/' . $post->image)}}" alt="{{$post->kategori->nama_kategori}}">
                    @endif
                    <div class="w-full">
                        <div class="flex justify-between bg-slate-300 w-full">
                            <p>{{$post->kategori->nama_kategori}}</p>
                            <div class="flex gap-2">
                                <a href="{{route('post.edit', ['post' => $post])}}">edit</a>
                                <form method="post" action="{{route('post.destroy', ['post' => $post])}}">
                                    @csrf
                                    @method('delete')
                                    <input type="submit" value="Delete">
                                </form>
                            </div>
                        </div>
                        <h1>{{$post->judul_post}}</h1>
                    </div>
                </div>
                @endforeach --}}
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection
