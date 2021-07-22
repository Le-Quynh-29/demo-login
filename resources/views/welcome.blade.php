<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{asset('css/styles.css')}}" rel="stylesheet">
</head>
<body>
<div class="wrapper fadeInDown">
    <div id="formContent">
        <!-- Tabs Titles -->
        <h2 class="active"> Sign In </h2>
{{--        <h2 class="inactive underlineHover">Sign Up </h2>--}}

        <!-- Icon -->
        <div class="fadeIn first">
            <img src="https://cdn.dribbble.com/users/1889528/screenshots/7239609/0aba6579301149.5cbf290c5a8dd.jpg" width="190px" height="100px" id="icon" alt="User Icon" />
        </div>

        <!-- Login Form -->
        <form action="{{route('login')}}" method="post">
            @csrf
            <input type="text" id="login" class="fadeIn second" name="email" placeholder="Your email">
            <input type="text" id="password" class="fadeIn third" name="password" placeholder="Your password">
            <input type="submit" class="fadeIn fourth" value="Log In">
        </form>

        <!-- Remind Passowrd -->
        <div id="formFooter">
            <a class="underlineHover" href="#">Forgot Password?</a>
        </div>

    </div>
</div>
</body>
</html>
