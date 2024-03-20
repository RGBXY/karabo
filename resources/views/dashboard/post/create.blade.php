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

    <form action="{{route('post.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <label for="">Pertanyaan</label>
        <input type="text" name="judul_post">
        <select name="kategori_id">
            @foreach ($kategoris as $kategori)
            <option value="{{$kategori->id}}" selected>{{$kategori->nama_kategori}}</option>
            @endforeach
        </select>
        <input type="file" name="image">
        <input type="submit" value="Kirim">
    </form>

</body>
</html>
