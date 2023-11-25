<html>

<head>
    <title>Online Booking</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
    <!-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/custom.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('css')
</head>

<body>
    <div class="container background-white-50 b-1-dark h5" id="mydiv" style="margin-top: 0px; margin-bottom: 0px;">
            <div id="mySidenav" class="sidenav">
                <div class="innerSidenav" id="innerSidenav">
                    <span class="menutitle">{{auth()->user()->first_name.' '.auth()->user()->last_name}}</span>
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                    <div><img class="wrapper p-5 back-white my-4" src="{{ asset('/images/fast-simple-logo.png') }}" />
                    </div>
                    @php
                        $user = auth()->user();
                        $permissions = \App\Helpers\PermissionHelper::permission_list();
                        $permission_roles = \App\Models\Permission_role::where('role_id', $user->role_id)->get();
                    @endphp
                   @foreach ($permission_roles as $item)
                        @if ($item->permission->name == 'Create Bookings')
                        <a href="{{ route('create_booking') }}" class="font140"><i class="fa fa-book color-sky pr-3 font140 py-1 minwidth50"></i><span class="font80">Create Booking</span></a>
                        @elseif ($item->permission->name == 'Manage Customers')
                        <a href="{{ route('customers') }}" class="font140"><i class="fa fa-folder color-sky pr-3 font140 py-1 minwidth50"></i><span class="font80">Customers</span></a>
                        @elseif ($item->permission->name == 'Manage Vehicles')
                        <a href="{{ route('vehicles') }}" class="font140"><i class="fa fa-car color-sky pr-3 font140 py-1 minwidth50"></i><span class="font80">Vehicles</span></a>
                        @elseif ($item->permission->name == 'Manage Drivers')
                        <a href="{{ route('drivers') }}" class="font140"><i class="fa fa-cog color-sky pr-3 font140 py-1 minwidth50"></i><span class="font80">Drivers</span></a>
                        @elseif ($item->permission->name == 'Manage Bookings')
                        <a href="{{ route('trips') }}" class="font140"><i class="fa fa-plane color-sky pr-3 font140 py-1 minwidth50"></i><span class="font80">Trips </span></a>
                        @elseif ($item->permission->name == 'Manage Users')
                        <a href="{{ route('users') }}" class="font140"><i class="fa fa-plane color-sky pr-3 font140 py-1 minwidth50"></i><span class="font80">Users </span></a>
                        @endif
                        
                   @endforeach

                    {{-- @if (\App\Helpers\PermissionHelper::hasPermission('Create Bookings'))
                        <a href="{{ route('create_booking') }}" class="font140"><i class="fa fa-book color-sky pr-3 font140 py-1 minwidth50"></i><span class="font80">Create Booking</span></a>
                    @endif
                    @if (\App\Helpers\PermissionHelper::hasPermission('Manage Customers'))
                        <a href="{{ route('customers') }}" class="font140"><i class="fa fa-folder color-sky pr-3 font140 py-1 minwidth50"></i><span class="font80">Customers</span></a>
                    @endif
                    @if (\App\Helpers\PermissionHelper::hasPermission('Manage Vehicles'))
                        <a href="{{ route('vehicles') }}" class="font140"><i class="fa fa-car color-sky pr-3 font140 py-1 minwidth50"></i><span class="font80">Vehicles</span></a>
                    @endif --}}
                    
                    <a href="{{ route('plans') }}" class="font140"><i class="fa fa-plane color-sky pr-3 font140 py-1 minwidth50"></i><span class="font80">Plans</span></a>
                    {{-- @if (\App\Helpers\PermissionHelper::hasPermission('Manage Drivers'))
                    <a href="{{ route('drivers') }}" class="font140"><i class="fa fa-cog color-sky pr-3 font140 py-1 minwidth50"></i><span class="font80">Drivers</span></a>
                    @endif --}}
                    @if(auth()->user()->id == auth()->user()->parent_id)
                    <a href="{{ route('my_account') }}" class="font140"><i class="fa fa-car color-sky pr-3 font140 py-1 minwidth50"></i><span class="font80">My Account</span></a>
                    <a href="{{ route('settings') }}" class="font140"><i class="fa fa-registered color-sky pr-3 font140 py-1 minwidth50"></i><span class="font80">Setting</span></a>
                    @endif
                    {{-- @if (\App\Helpers\PermissionHelper::hasPermission('Manage Bookings'))
                    <a href="{{ route('trips') }}" class="font140"><i class="fa fa-plane color-sky pr-3 font140 py-1 minwidth50"></i><span class="font80">Trips </span></a>
                    @endif
                    @if (\App\Helpers\PermissionHelper::hasPermission('Manage Users'))
                    <a href="{{ route('users') }}" class="font140"><i class="fa fa-plane color-sky pr-3 font140 py-1 minwidth50"></i><span class="font80">Users </span></a>
                    @endif  --}}
                    @if (auth()->user()->role_id == 1)
                    <a href="{{ route('roles') }}" class="font140"><i class="fa fa-plane color-sky pr-3 font140 py-1 minwidth50"></i><span class="font80">Role Managment</span></a>
                    <a href="{{ route('manage_plan') }}" class="font140"><i class="fa fa-plane color-sky pr-3 font140 py-1 minwidth50"></i><span class="font80">Plan Managment</span></a>
                    @endif
                    <a href="{{ route('disconnection') }}" class="font140"><i class="fa fa-cog color-sky pr-3 font140 py-1 minwidth50"></i><span class="font80">Log out</span></a>

                </div>
            </div>
        <div class="myContentDiv">
            @yield('content')
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
        integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
    <script src="{{ asset('js/custom.js?3.1') }}"></script>
    <script src="{{ asset('js/toogleSwitch.js') }}"></script>
</body>

</html>
