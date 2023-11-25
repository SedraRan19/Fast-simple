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
    <div class="row text-center mt-5">
        <div class="col-md-12">
            <h4 class="font-weight-bold registerText">Registration</h4>
        </div>
    </div>
    <form method="POST" action="{{route('register')}}">
        @csrf
        <div class="settings-panel" style="margin: 65px 10px !important;">
            <div class="row text-center">
                <div class="col-md-12">
                    <span class="changeLogo"><img class="position-relative p-2 back-white"
                            src="{{ asset('/images/fast-simple-logo.png') }}"
                            style="margin-top: -80px; width: 204px; height: auto;" /></span>
                </div>
            </div>
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
            <div class="px-4 py-2 pt-5 row mt-5">
                <p class="wrapper border-none back-white outline-none font-weight-bold color-dark-gray pl-3 mb-0">Please
                    complete this form</p>
                <div class="stroke-line wrapper pb-3"></div>
            </div>
            <div class="px-4 py-2 row">
                <input value="{{ old('email') }}"  type="email"
                    class="wrapper border-none back-white outline-none font-weight-bold"
                    name="email" placeholder="Enter Email Address">
                <div class="stroke-line wrapper pb-2"></div>
            </div>
            <div class="px-4 py-2 row">
                <input onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                    class="wrapper border-none back-white outline-none font-weight-bold"
                    value="{{ old('phone') }}" oninput="formatAllPhoneNumbers(this);" name="phone" placeholder="Enter Phone Number" 
                    minlength="10"  type="tel" />
                <div class="stroke-line wrapper pb-2"></div>
            </div>
            <div class="px-4 py-2 row">
                <input
                    class="wrapper border-none back-white outline-none font-weight-bold"
                    name="password" type="password" placeholder="Enter password"  />
                <div class="stroke-line wrapper pb-2"></div>
            </div>
            <div class="px-4 py-2 row">
                <input class="wrapper border-none back-white outline-none font-weight-bold"
                    name="confirm_password" type="password" placeholder="Repeat Password"  />
                <div class="stroke-line wrapper pb-3"></div>
            </div>
            <div class="px-4 py-2 row mt-5">
                <div class="col-md-12 text-center">
                    <span id="error-msg" class="color-red pl-3 font120 letter-spacing-1 font-weight-bold"></span>
                    <button
                        class="text-center p-4 wrapper selectable-button-selected font120 font-weight-bold letter-spacing-1 text-white"
                        type="submit" >Create account</button>
                </div>
            </div>

            <div class="row">
                <a href="{{ route('login') }}" class="wrapper p-4 text-center">Already have an account? Login</a>
            </div>
        </div>
    </form>

</div>
</div>
{{-- <script>
    function formatAllPhoneNumbers(obj) {
    var txt = $(obj).val();
    var formated;
    if (txt.length == 10) formated = formatPhoneNumber(txt);
    else formated = txt;
    $(obj).val(formated);
}

</script> --}}
@yield('scripts')
</body>
</html>

