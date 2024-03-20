<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @if($errors->any())
    @foreach ($errors->all() as $errors)
    <p>{{$errors}}</p>
    @endforeach
    @endif
    
    <form action="{{route('post.update', ['post' => $post])}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <label for="">Pertanyaan</label>
        <input type="text" name="judul_post" value="{{$post->judul_post}}">
        <select name="kategori_id">
            @foreach ($kategoris as $kategori)
            <option value="{{$kategori->id}}" selected>{{$kategori->nama_kategori}}</option>
            @endforeach
        </select>
        <input type="file" name="image">
        <img src="{{ asset('storage/' . auth()->user()->profile_image) }}" alt="Profil">
        <img width="30px" src="{{asset('storage/' . $post->image)}}" alt="{{$post->kategori->nama_kategori}}">
        <input type="submit" value="Update">
    </form>

</body>
</html>
