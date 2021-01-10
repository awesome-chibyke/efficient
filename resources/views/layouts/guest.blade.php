<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<meta name="csrf-token" content="{{ csrf_token() }}">

    @include('fincludes.head')
    <body>

        <div class="secondary-pages homepage-02">

            <!--- Preloader Start -->
            <div id="onyx-preloader">
                <div  class="preloader">
                    <div class="spinner"></div>
                    <div class="loader">
                        <span data-text="E." class="letter-animation">E.</span>
                        <span data-text="F." class="letter-animation">F.</span>
                        <span data-text="F." class="letter-animation">F.</span>
                        <span data-text="I." class="letter-animation">I.</span>
                        <span data-text="C." class="letter-animation">C.</span>
                        <span data-text="C." class="letter-animation">C</span>
                        <span data-text="I." class="letter-animation">I</span>
                        <span data-text="E." class="letter-animation">E</span>
                        <span data-text="N." class="letter-animation">E</span>
                        <span data-text="T." class="letter-animation">T</span>
                    </div>
                </div>
            </div>
            <!-- Preloader End -->

            @include('fincludes.header')

            {{--{{ $slot }}--}}
            @yield('content')

        </div>
    </body>

    @include('fincludes.footer')

    <!-- Scripts -->
    <script src="{{asset('js/custom/jquery.js')}}" ></script>
    <script src="{{asset('js/custom/generics.js')}}" ></script>
    <script src="{{asset('js/custom/roles_js.js')}}" ></script>
    <script src="{{asset('js/custom/requestHandler.js')}}" ></script>

    <!--sweet alert-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!--f js-->
    <!--  JavaScripts  -->
    {{--<script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="assets/js/jquery-3.4.1.min.js"></script>
    <script src="{{asset('front/assets/js/bootstrap.js')}}"></script>--}}
    <script src="{{asset('front/assets/js/menu.html')}}"></script>
    <script src="{{asset('front/assets/js/swiper.min.js')}}"></script>
    <script src="{{asset('front/assets/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('front/assets/js/jquery.countTo.js')}}"></script>
    <script src="{{asset('front/assets/js/onyx.js')}}"></script>

    <!--datatables-->
    @php $dataBankPages = ['verifications']; @endphp
    @php $currentPageName = Request::segment(1); @endphp
    @if(in_array($currentPageName, $dataBankPages))
        <script src="{{asset('js/banks.js')}}"></script>
        <script>

            $(document).ready(function () {
                let selected_bank_code = $("#selected_bank").val();
                selected_bank_code = typeof selected_bank_code === 'undefined' ? $(".bank_code").attr('data-bank-code') : selected_bank_code;
                let banks = getBanks(selected_bank_code);

                $(".bank_code").html(banks);
            })

            function dropBankName(a) {
                let selectedValue = $(a).find("option:selected").text();

                $(a).siblings('.bank_name').val(selectedValue)
            }

        </script>
    @endif

<!--data tables-->
    @php $dataTablePages = ['']; @endphp
    @php $currentPageName = Request::segment(1); @endphp
    @if(in_array($currentPageName, $dataTablePages))
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js" ></script>
        <script>
            $(document).ready( function () {
                $('#myTable').DataTable();
            } );
        </script>
    @endif

    @php $pageErrorArray = ['login', 'register', 'settings_page', 'editProfile', 'wallet', 'investments_settings', 'create_gallery_view', 'compose', 'add_funds', 'login_authenticator'];  @endphp
    @if(@in_array( request()->segment(1), $pageErrorArray))
        <script src="{{asset('js/custom/errors/error_helper.js')}}" ></script>
        <link type="text/css" rel="stylesheet" href="{{asset('js/custom/errors/error_css.css')}}">
        <script>
            $(document).ready(function () {
                showErrors();
            });
        </script>
    @endif

</html>
