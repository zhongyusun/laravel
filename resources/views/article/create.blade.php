<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
nishizhu
<form action="{{route('article.store')}}" method="post">
    <input type="text" name="user">
    @csrf
    <br>
    <button>登录</button>
</form>
</body>
</html>