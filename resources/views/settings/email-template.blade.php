@extends('layouts.app')
@section('content')
    <div class="row py-4">
        <div class="col-md-12">
            <a onclick="openNav()"><i class="fa fa-bars p-4"></i></a>
        </div>
    </div>
    <div class="row text-center mt-5">
        <div class="col-md-12">
            <h4 class="font-weight-bold registerText">Email Templates</h4>
        </div>
    </div>
    <form method="post" action="{{ url('/update-template-setting') }}">
        @csrf
        <div class="settings-panel" style="margin: 65px 10px !important;">
            <div class="row text-center">
                <div class="col-md-12">
                    <span class="changeLogo"><img class="position-relative p-2 back-white"
                            src="{{ asset('/images/fast-simple-logo.png') }}"
                            style="margin-top: -80px; width: 204px; height: auto;" /></span>
                </div>
            </div>
            <div class="px-4 py-2 pt-4 row">
                <p class="wrapper border-none back-white outline-none font-weight-bold color-dark pl-3 mb-0"
                    style="letter-spacing: 0.7px">Booking Confirmation Email 
                    <i class="fa fa-info-circle" aria-hidden="true"
                    data-toggle="tooltip" data-trigger="click" data-placement="bottom" title="{First Name}" onClick="copyToClipboard('{First Name}')"></i>
                    <!-- <a href="#" data-toggle="tooltip" data-trigger="click" data-placement="top" title="Hooray!">Toggle popover</a> -->
                </p>
                <div class="stroke-line wrapper pb-3"></div>
            </div>
            <div class="px-4 py-2 row">
                <textarea rows="10"
                class="wrapper border-none background-white outline-none"
                spellcheck="true" name="templates[booking_confirmation]" id="booking_confirmation" placeholder="Enter Booking Confirmation Message">xxx</textarea>

                <div class="stroke-line wrapper pb-3"></div>
                    <span class="invalid-feedback" role="alert">
                                <strong>xxx</strong>
                    </span>
            </div>

            <div class="px-4 py-2 pt-4 row">
                <p class="wrapper border-none back-white outline-none font-weight-bold color-dark pl-3 mb-0"
                    style="letter-spacing: 0.7px">Booking Cancellation Email
                    <i class="fa fa-info-circle" aria-hidden="true"
                    data-toggle="tooltip" data-trigger="click" data-placement="bottom" rel="popover" data-bs-trigger="hover" title="{First Name}  {Booking#}" onClick="copyToClipboard('{First Name} {Booking#}')"></i>
                </p>
                <div class="stroke-line wrapper pb-3"></div>
            </div>
            <div class="px-4 py-2 row">
                <textarea rows="10"
                class="wrapper border-none background-white outline-none"
                spellcheck="true" name="templates[booking_cancellation]" id="booking_cancellation" placeholder="Enter Booking Cancellation Message">xxx</textarea>

                <div class="stroke-line wrapper pb-3"></div>
                    <span class="invalid-feedback" role="alert">
                                <strong>xxx</strong>
                    </span>
            </div>

            <div class="px-4 py-2 pt-4 row">
                <p class="wrapper border-none back-white outline-none font-weight-bold color-dark pl-3 mb-0"
                    style="letter-spacing: 0.7px">Payment Confirmation Email
                    <i class="fa fa-info-circle" aria-hidden="true"
                    data-toggle="tooltip" data-trigger="click" data-placement="bottom" rel="popover" data-bs-trigger="hover" title="{First Name}" onClick="copyToClipboard('{First Name}')"></i>
                </p>
                <div class="stroke-line wrapper pb-3"></div>
            </div>
            <div class="px-4 py-2 row">
                <textarea rows="10"
                class="wrapper border-none background-white outline-none"
                spellcheck="true" name="templates[payment_confirmation]" id="payment_confirmation" placeholder="Enter Payment Confirmation Message">xxx</textarea>

                <div class="stroke-line wrapper pb-3"></div>
                    <span class="invalid-feedback" role="alert">
                                <strong>xxx</strong>
                    </span>
            </div>

            <div class="px-4 py-2 pt-4 row">
                <p class="wrapper border-none back-white outline-none font-weight-bold color-dark pl-3 mb-0"
                    style="letter-spacing: 0.7px">Refund Confirmation Email
                    <i class="fa fa-info-circle" aria-hidden="true"
                    data-toggle="tooltip" data-trigger="click" data-placement="bottom" rel="popover" data-bs-trigger="hover" title="{First Name} {Booking#} {Amount}" onClick="copyToClipboard('{First Name} {Booking#} {Amount}')"></i>
                </p>
                <div class="stroke-line wrapper pb-3"></div>
            </div>

            <div class="px-4 py-2 row">
                <textarea rows="10"
                class="wrapper border-none background-white outline-none"
                spellcheck="true" name="templates[refund_confirmation]" id="refund_confirmation" placeholder="Enter Refund Confirmation Message">xxx</textarea>

                <div class="stroke-line wrapper pb-3"></div>
                    <span class="invalid-feedback" role="alert">
                                <strong>xxx</strong>
                    </span>
            </div>

            <div class="px-4 py-2 pt-4 row">
                <p class="wrapper border-none back-white outline-none font-weight-bold color-dark pl-3 mb-0"
                    style="letter-spacing: 0.7px">Driver Assingment Email
                    <i class="fa fa-info-circle" aria-hidden="true"
                    data-toggle="tooltip" data-trigger="click" data-placement="bottom" rel="popover" data-bs-trigger="hover" title="{First Name} {Date} {Driver first name} {Driver last name} " onClick="copyToClipboard('{First Name} {Date} {Driver first name} {Driver last name}')"></i>
                </p>
                <div class="stroke-line wrapper pb-3"></div>
            </div>

            <div class="px-4 py-2 row">
                <textarea rows="10"
                class="wrapper border-none background-white outline-none"
                spellcheck="true" name="templates[driver_assingment_email]" id="driver_assingment_email" placeholder="Enter Driver Assingment Message">xxx</textarea>

                <div class="stroke-line wrapper pb-3"></div>
                    <span class="invalid-feedback" role="alert">
                                <strong>xxx</strong>
                    </span>
            </div>


            <div class="px-4 py-2 row">
                <div class="col-md-12">
                    <button
                        class="text-center p-4 wrapper selectable-button-selected font120 font-weight-bold letter-spacing-1 text-white"
                        type="submit">Save Templates</button>
                </div>
            </div>
        </div>
    </form>
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"> -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
    </script>

@endsection
