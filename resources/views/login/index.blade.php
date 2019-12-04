<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="{{asset('backend/css/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('backend/css/font-awesome.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('backend/css/style.css')}}" type="text/css">
</head>
<body>
<div class="main d-flex">
    <div class="col-lg-6 d-none d-lg-block px-0">
        <img class="w-100" src="{{asset('backend/images/Group 244.png')}}" style="height: 100vh;">
    </div>
    <div class="col-lg-6">
        <div class="content" style="height: 95vh">
            <div class="main-form w-75">
                <div class="main-title text-center mb-4">
                    <h3>セミナー管理システム</h3>
                    <small>Welcome back! Please login to your account.</small>
                </div>
                <form action="{{route('admin.post.login')}}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-group">
                        <input type="email" class="input100 mb-4" name="email" placeholder="Username">
                        @if($errors->has('email'))
                            <p class="text-danger">{{$errors->first('email')}}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="password" class="input100 mb-4" name="password" placeholder="Password">
                        @if($errors->has('password'))
                            <p class="text-danger">{{$errors->first('password')}}</p>
                        @endif
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1" name="remember">
                        <label class="form-check-label" for="exampleCheck1">Remember me</label>
                    </div>
                    <div class="form-group text-center text-danger">
                        @if(old('notice'))
                            {{old('notice')}}
                        @endif
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="px-5 py-2 bt-login justify-content-lg-end">Login</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-12 text-center ">
            Copyright@xxxxxxxxxxxxxxx
        </div>
    </div>
</div>
</body>
</html>
