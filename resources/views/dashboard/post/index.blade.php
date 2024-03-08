<x-app-layout>
    <div>
        @if(session()->has('success'))
            <div>
                {{session('success')}}
            </div>
        @endif
    </div>

    <div>
        <p>Halo {{auth()->user()->name}}</p>
        @foreach ($posts as $post)
        <h1>{{$post->judul_post}}</h1>
        <p>{{$post->kategori->nama_kategori}}</p>      
        <a href="{{route('post.edit', ['post' => $post])}}">edit</a>
        <form method="post" action="{{route('post.destroy', ['post' => $post])}}">
            @csrf
            @method('delete')
            <input type="submit" value="Delete">
        </form>
        @endforeach

        <a href="{{route('post.create')}}">Buat Pertanyaan</a>
    </div>
</x-app-layout>