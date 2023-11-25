@extends('layouts.app')
@section('content')
    <div class="row py-4">
        <div class="col-md-12">
            <a onclick="openNav()"><i class="fa fa-bars p-4"></i></a>
            <span class="text-center font-weight-bold text-dark maintitle">User</span>
        </div>
    </div>

    <form method="post" action="{{route('update_user',['id'=>$user->id])}}">
        @csrf
        <div class="settings-panel" style="margin: 65px 10px !important;">
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
            <div class="row text-center">
                <div class="col-md-12">
                    <span class="changeLogo"><img class="position-relative p-2 back-white"
                            src="{{ asset('/images/fast-simple-logo.png') }}"
                            style="margin-top: -80px; width: 204px; height: auto;" /></span>
                </div>
            </div>
            <div class="px-4 py-2 pt-4 row">
                <p class="wrapper border-none back-white outline-none font-weight-bold color-dark pl-3 mb-0"
                    style="letter-spacing: 0.7px">First name</p>
                <div class="stroke-line wrapper pb-3"></div>
            </div>
            <div class="px-4 py-2 row">
                <input
                    class="wrapper border-none background-white outline-none"
                    name="first_name" placeholder="Type First Name"
                    value="{{$user->first_name}}" />
                <div class="stroke-line wrapper pb-3"></div>
            </div>

            <div class="px-4 py-2 pt-4 row">
                <p class="wrapper border-none back-white outline-none font-weight-bold color-dark pl-3 mb-0"
                    style="letter-spacing: 0.7px">Last name</p>
                <div class="stroke-line wrapper pb-3"></div>
            </div>
            <div class="px-4 py-2 row">
                <input
                    class="wrapper border-none background-white outline-none"
                    name="last_name" placeholder="Type Last Name"
                    value="{{$user->last_name}}" />
                <div class="stroke-line wrapper pb-3"></div>
            </div>

            <div class="px-4 py-2 pt-4 row">
                <p class="wrapper border-none back-white outline-none font-weight-bold color-dark pl-3 mb-0"
                    style="letter-spacing: 0.7px">Email</p>
                <div class="stroke-line wrapper pb-3"></div>
            </div>
            <div class="px-4 py-2 row">
                <input type="email"
                    class="wrapper border-none background-white outline-none"
                    name="email" placeholder="Type Email"
                    value="{{$user->email}}" />
                <div class="stroke-line wrapper pb-3"></div>
            </div>

            <div class="px-4 py-2 pt-4 row">
                <p class="wrapper border-none back-white outline-none font-weight-bold color-dark pl-3 mb-0"
                    style="letter-spacing: 0.7px">Phone Number</p>
                <div class="stroke-line wrapper pb-3"></div>
            </div>
            <div class="px-4 py-2 row">
                <input type="tel" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                    class="wrapper border-none background-white outline-none"
                    name="phone" placeholder="Type Phone Number"
                    value="{{$user->phone}}" oninput="formatAllPhoneNumbers(this);" />
                <div class="stroke-line wrapper pb-3"></div>
            </div>

            <div class="px-4 py-2 pt-4 row">
            <p class="wrapper border-none back-white outline-none font-weight-bold color-dark pl-3 mb-0"
                style="letter-spacing: 0.7px">Role</p>
            <div class="stroke-line wrapper pb-3"></div>
            </div>
            <div class="px-4 py-2 row">
                <select class="wrapper border-none background-white outline-none p-2" name="role_id">
                    <option value="" selected disabled>Select Role</option>
                    @foreach($roles as $role)
                    @if( $user->role_id == $role->id)
                        <option value="{{ $role->id }}" selected>
                            {{ $role->name }}
                        </option>
                    @else
                    <option value="{{ $role->id }}">
                        {{ $role->name }}
                    </option>
                    @endif
                    @endforeach
                </select>                
            <div class="stroke-line wrapper pb-3"></div>
            </div>
            {{-- <div class="px-4 py-2 pt-4 row">
                <p class="wrapper border-none back-white outline-none font-weight-bold color-dark pl-3 mb-0"
                    style="letter-spacing: 0.7px">Password</p>
                <div class="stroke-line wrapper pb-3"></div>
            </div>
            <div class="px-4 py-2 row">
                <input type="password"
                    class="wrapper border-none background-white outline-none"
                    name="password" placeholder="Type Password"
                    value="" />
                <div class="stroke-line wrapper pb-3"></div>
            </div>

            <div class="px-4 py-2 pt-4 row">
                <p class="wrapper border-none back-white outline-none font-weight-bold color-dark pl-3 mb-0"
                    style="letter-spacing: 0.7px">Confirm password</p>
                <div class="stroke-line wrapper pb-3"></div>
            </div>
            <div class="px-4 py-2 row">
                <input type="password"
                    class="wrapper border-none background-white outline-none"
                    name="confirm_password" placeholder="Confirm your password"
                    value="" />
                <div class="stroke-line wrapper pb-3"></div>
            </div> --}}

            <div class="px-4 py-2 row">
            <div class="col-md-12">
            <button
                class="text-center p-4 wrapper selectable-button-selected font120 font-weight-bold letter-spacing-1 text-white"
                type="submit">Save</button>
            <p class="text-center" style="margin-top:10px">The user will receive an email to <br> create a password and sign in</p>
            </div>
            </div>
    </div>
</form>

@endsection
