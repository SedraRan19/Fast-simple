@extends('layouts.app')
@section('content')
<div class="row text-center mt-5">
    <div class="col-md-12">
        <h4 class="font-weight-bold registerText">Registration
            <span class="position-relative left-100">
                <a class="font140" href="#" onclick="">
                    <i class="fa fa-power-off color-sky pr-3 font100 py-1 minwidth50"></i>
                </a>
                <form id="logout-form" action="" method="POST" class="d-none">
                    @csrf
                </form>
            </span>
        </h4>
    </div>
</div>
<div class="settings-panel" style="margin: 65px 10px !important;">
    <div class="row text-center">
        <div class="col-md-12">
            <span class="changeLogo"><img class="position-relative p-2 back-white" src="{{ asset('/images/fast-simple-logo.png') }}" style="margin-top: -80px; width: 204px; height: auto;" /></span>
        </div>
    </div>

    <div class="px-4 py-2 pt-5 row">
        <p class="wrapper border-none back-white outline-none font-weight-bold color-dark-gray pl-3 font120">Verify your email</p>
    </div>

    <div class="px-4 py-2 pt-3 row">
        <p class="wrapper border-none back-white outline-none font-weight-bold color-dark-gray pl-3 font120">We just sent you an email to <br> EMAIL ADDRESS.</p>
    </div>

    <div class="px-4 py-2 pt-3 row">
        <p class="wrapper border-none back-white outline-none font-weight-bold color-dark-gray pl-3 font120">This email contains a verification link.</p>
    </div>

    <div class="px-4 py-2 pt-3 row">
        <p class="wrapper border-none back-white outline-none font-weight-bold color-dark-gray pl-3 font120">Please click that verification link to <br> complete your registration</p>
    </div>

    <div class="px-4 py-2 row mt-5">
        <div class="col-md-12 text-center">
            @if (session('resent'))
            <div class="color-green mb-3 letter-spacing-1 font100 font-weight-bold">
                {{ __('A fresh verification link has been sent to your email address.') }}
            </div>
            @endif
            <form class="d-inline" method="POST" action="#">
                @csrf
                <button type="submit" id="create-account" class="text-center p-4 wrapper selectable-button-selected font120 font-weight-bold letter-spacing-1 text-white">Resend verification</button>
            </form>
        </div>
    </div>
</div>
@endsection
