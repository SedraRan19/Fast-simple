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
        <div id="mySidenav" class="sidenav">
            <div class="innerSidenav" id="innerSidenav">
                {{-- <span class="menutitle">Menu</span>
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                <div><img class="wrapper p-5 back-white my-4" src="{{URL::to('/images')}}/Logo.png" /></div> --}}
            </div>
        </div>
        <div class="myContentDiv">
            @yield('content_auth')
        </div>
    </div>
    @yield('scripts')
</body>
</html>
