
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
{{--successed!--}}
{{--<div> {{$ip->ip}}</div>--}}
@foreach($sessions as $val)
    <a href="{{route('logout', $val->id)}}">Logout</a>
{{--    @break()--}}
@endforeach
{{--<a href="{{route('logout', $user->id)}}">Logout</a>--}}
{{--<a href="{{route('ip_address')}}">{{$user->name}}</a>--}}
</body>
</html>
