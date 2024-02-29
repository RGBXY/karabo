<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{route('post.update', ['post' => $post])}}" method="post">
        @csrf
        @method('put')
        <label for="">Pertanyaan</label>
        <input type="text" name="judul_post" value="{{$post->judul_post}}">
        <input type="submit" value="Update">
    </form>

</body>
</html>
