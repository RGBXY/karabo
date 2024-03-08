<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{route('kategori.update', ['kategori' => $kategori])}}" method="post">
        @csrf
        @method('put')
        <label for="">Kategori</label>
        <input type="text" name="nama_kategori" value="{{$kategori->nama_kategori}}">
        <input type="submit" value="Update">
    </form>

</body>
</html>
