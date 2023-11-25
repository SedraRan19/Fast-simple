@extends('layouts.app')
@section('content')
    <div class="row text-center mt-5">
        <div class="col-md-12">
            <h4 class="font-weight-bold registerText">Set Password
                <span class="position-relative left-100">
                    <a class="font140" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa fa-power-off color-sky pr-3 font100 py-1 minwidth50"></i>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </span></h4>
        </div>
    </div>
    <form method="post" action="">
        @csrf
        <div class="settings-panel" style="margin: 65px 10px !important;">
            <div class="row text-center">
                <div class="col-md-12">
                    <span class="changeLogo"><img class="position-relative p-2 back-white" src="{{ asset('/images/fast-simple-logo.png')}}" style="margin-top: -80px; width: 204px; height: auto;"/></span>
                </div>
            </div>
            @if ($message = Session::get('success'))
                <div class="color-green text-center font100 font-weight-bold">
                    <p>{{$message}}</p>
                </div>
            @endif

            <input type="hidden" name="id" value="{{$user->id}}">
            <div class="px-4 py-2 row">
                <input readonly class="wrapper border-none back-white outline-none font-weight-bold" name="email" value="{{$user->email}}"/>
                <div class="stroke-line wrapper pb-3"></div>
            </div>
            <div class="px-4 py-2 row">
                <input type="password" class="{{ $errors->has('password') ? 'is-invalid' : '' }} wrapper border-none back-white outline-none font-weight-bold" name="password" placeholder="Enter New Password" value=""/>
                <div class="stroke-line wrapper pb-3"></div>
                @if($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                </span>
                @enderror
            </div>
            <div class="px-4 py-2 row">
                <input required type="password" class="{{ $errors->has('password_confirmation') ? 'is-invalid' : '' }} wrapper border-none back-white outline-none font-weight-bold" name="password_confirmation" placeholder="Confirm Password" value=""/>
                <div class="stroke-line wrapper pb-3"></div>
                @if($errors->has('password_confirmation'))
                <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
                @enderror
            </div>
            <div class="px-4 py-2 row">
                <div class="col-md-12">
                    <button class="text-center p-4 wrapper selectable-button-selected font120 font-weight-bold letter-spacing-1 text-white" type="submit">Save</button>
                </div>
            </div>
        </div>
    </form>
@endsection
