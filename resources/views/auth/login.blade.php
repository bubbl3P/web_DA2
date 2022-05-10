{{--<form action="{{route('process_login')}}" method="post">--}}
{{--    @csrf--}}
{{--    Email--}}
{{--    <input type="email" name="email" placeholder="">--}}
{{--    Password--}}
{{--    <input type="password" name="password" placeholder="">--}}
{{--    <button>Login</button>--}}
{{--</form>--}}


<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<head>
    <title>Login Page</title>
    <!--Made with love by Mutiullah Samim -->

    <!--Bootsrap 4 CDN-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!--Fontawesome CDN-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <!--Custom styles-->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/login-css.css') }} ">
</head>
<body>
<div class="container">
    <div class="d-flex justify-content-center h-100">
        <div class="card">
            <div class="card-header">
                <h3>Login</h3>
                <div class="d-flex justify-content-end social_icon">
                    <span><a target="_blank"  href = "https://www.facebook.com/duy.eddie01/" class="fab fa-facebook-square icon"></a></span>
                    <span><a target="_blank" href = "https://twitter.com/Duy98331390" class="fab fa-twitter-square icon"></a></span>
                    <span><a target="_blank" href = "https://www.google.com/maps/place/10%C2%B006'44.6%22N+105%C2%B045'59.6%22E/@10.112397,105.7660158,19z/data=!3m1!4b1!4m6!3m5!1s0x0:0xf570fe235be79045!7e2!8m2!3d10.1123966!4d105.7665629 " class="fas fa-map icon"></a></span>
                </div>
            </div>
            <div class="card-body">
                <form action="{{route('process_login')}}" method="post">
                    @csrf
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="email" class="form-control" placeholder="email" name="email">

                    </div>
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="password" class="form-control" placeholder="password" name="password">
                    </div>
                    <div class="row align-items-center remember">
                        <input type="checkbox">Remember Me
                    </div>
                    <div class="form-group">
                        <button class="btn float-right login_btn">Login</button>
                    </div>
                </form>




            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-center links">
                    Don't have an account?<a style="margin-left: 15px" href="{{route('signup')}}">Sign Up</a>
                </div>
                <div class="d-flex justify-content-center">
                    <a href="#">Forgot your password?</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
