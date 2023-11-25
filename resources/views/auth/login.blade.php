<html>
<head>
    <title>Online Booking</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
    <!-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{url('/css/style.css')}}">
    <link rel="stylesheet" href="{{url('/css/custom.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
     href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('css')
</head>

<body>
    <div class="container background-white-50 b-1-dark h5" id="mydiv" style="margin-top: 0px; margin-bottom: 0px;">
        <div class="myContentDiv">
<div id="mydiv">
    <div class="background-white-50 h3 mt-0 border-bottom-0 mb-0">
        <div class="p-4 pt-5">
            <div class="row">
                <h1 class="text-center wrapper font-weight-bold text-dark">Sign in</h1>
            </div>
            <div class="row">
                <img class="wrapper p-logo" src="{{asset('/images/fast-simple-logo.png')}}" />
            </div>
            <form action="{{ route('validation_login') }}" method="post">
                @csrf
                @if(session()->has("success"))
                    <div class="alert alert-success" >
                        {{session()->get('success')}}
                    </div>
                @endif
                @if(session()->has("error"))
                    <div class="alert alert-danger" >
                        {{session()->get('error')}}
                    </div>
                @endif
                <div class="row">
                    <input class="wrapper border-none background-white-50 outline-none" name="email" placeholder="email" value="{{old('email')}}" />
                    <div class="stroke-line wrapper pb-5"></div>
                </div>

                <div class="row">
                    <input class="wrapper border-none background-white-50 outline-none" name="password" type="password" placeholder="password" value="{{old('password')}}" />
                    <div class="stroke-line wrapper pb-5"></div>
                </div>

                <div class="row">
                    <a href="{{ route('forgot_password') }}" class="text-right text-primary wrapper normalfont">Forgot Password?</a>
                </div>

                <div class="row">
                    <input class="resolution-12 normalfont m-0" type="checkbox" id="remember" name="remember" value="remember" />
                    <label for="remember" class="normalfont">&nbsp;&nbsp;Remember Me</label>
                </div>

                <div class="row">
                    <button type="submit" class="border-radius-50 wrapper border-none p-4 text-white font-weight-bold mt-5">Sign in</button>
                </div>

                <div class="row">
                    <a href="{{route('register')}}" class="border-radius-50 wrapper border-none p-4 text-white mt-5 text-center">Create a business account</a>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>
@yield('scripts')
</body>
</html>