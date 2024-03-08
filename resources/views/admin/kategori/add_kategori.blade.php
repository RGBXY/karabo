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

    <form action="{{route('kategori.store')}}" method="post">
        @csrf
        @method('post')
        <label for="">Kategori</label>
        <input type="text" name="nama_kategori">
        <input type="submit" value="Kirim">
    </form>

</body>
</html>
