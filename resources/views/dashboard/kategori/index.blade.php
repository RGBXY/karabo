<x-app-layout>
    <div>
        @foreach ($kategoris as $kategori)
        <h1>{{$kategori->nama_kategori}}</h1>
        <a href="{{route('kategori.edit', ['kategori' => $kategori])}}">Edit</a>
        <form method="post" action="{{route('kategori.destroy', ['kategori' => $kategori])}}">
            @csrf
            @method('delete')
            <input type="submit" value="Delete">
        </form>
        @endforeach
    </div>
    <a href="{{route('post.kategori')}}">Buat Kategori</a>
</x-app-layout>
