<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<div class="users">
    @if($errors->any())
    <div>
        <ul>
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
        </ul>
    </div>
    @endif
    <div>
        <form method="POST" action="{{ route('inst.post') }}" enctype='multipart/form-data'>
            @csrf
            <input type="file" name="image" />
            <button type="submit">送信する</button>
        </form>
    </div>
</div>
<script src="{{ asset('js/app.js') }}" defer></script>
    
</body>
</html>



