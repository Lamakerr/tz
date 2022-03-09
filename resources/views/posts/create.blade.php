<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>создание поста</title>
</head>
<body>
    <form action="{{route('user.posts.store')}}" method="POST">
    <label for="title">Название поста</label>
    <input type="text" name='title' id="title">
    <x-error name='title'/>
    <br/>
    <label for="content">Контент поста</label>
    <textarea name="content" id="content" cols="30" rows="10">Контент</textarea>
    <x-error name='content'/>
    <br/>
    <label for="hashtags">Придумайте хэштеги. Запишите их разделив между собой запятой. </label>
     <input type="text" name="hashtags" id="hashtags"/>
     <x-error name='hashtags'/>
     <br/>
     <button type="submit">Отправить</button>
     @csrf
    </form>
    
</body>
</html>