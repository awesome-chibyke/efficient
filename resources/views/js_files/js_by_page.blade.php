<!--datatables-->
@php $dataTablePages = ['wallet', 'get_top_up_with_conditions', 'view_all_roles', 'all_user_type', 'add_role_for_user', 'confirmed_wallet', 'charge', 'show_all_withdrawals', 'show_all_confirmed_withdrawals', 'show_withdrawals_with_conditions', 'all_users', 'all_admin', 'all_super_admin', 'view_gallery_events', 'view_all_news', 'view_fags', 'getAccountDetails', 'view_investments', 'view_due_investments', 'view_investment_history', 'view_investments', 'investment_referral', 'view_due_investments']; @endphp
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

<!--roles pages-->
@php $rolesPages = ['view_all_roles', 'all_user_type', 'add_role_for_user', 'add_roles', 'add_user_type']; @endphp
@php $currentPageName = Request::segment(1); @endphp
@if(in_array($currentPageName, $rolesPages))
    <script src="{{asset('js/custom/roles_js.js')}}" ></script>
@endif

<!--gallery pages-->
@php $galleryPages = ['create_gallery_view', 'view_gallery_events', 'view_single_gallery', 'edit_gallery_page']; @endphp
@php $currentPageName = Request::segment(1); @endphp
@if(in_array($currentPageName, $galleryPages))
    <script src="{{asset('js/custom/gallery.js')}}" ></script>
@endif

{{--errors--}}
@php $pageErrorArray = ['show_top_up_transactions', 'main_settings_page', 'settings_page', 'editProfile', 'wallet', 'investments_settings', 'create_gallery_view', 'compose', 'add_funds', 'login_authenticator', 'show_all_withdrawals', 'create_news_view', 'create_faqs_page', 'create_investment_interface'];  @endphp
@if(@in_array( request()->segment(1), $pageErrorArray))
    <link type="text/css" rel="stylesheet" href="{{asset('js/custom/errors/error_css.css')}}">
    <script src="{{asset('js/custom/errors/error_helper.js')}}" ></script>
    <script>
        $(document).ready(function () {
            showErrors();
        });
    </script>
@endif

{{--profile page--}}
@php $pageProfileArray = ['profile'];  @endphp
@if(@in_array( request()->segment(1), $pageProfileArray))
    <link type="text/css" rel="stylesheet" href="{{asset('js/custom/errors/error_css.css')}}">
    <script src="{{asset('js/custom/profile.js')}}" ></script>
@endif

{{--wallet--}}
@php $pageWalletArray = ['wallet', 'get_top_up_with_conditions'];  @endphp
@if(@in_array( request()->segment(1), $pageWalletArray))
    <script src="{{asset('js/custom/wallet.js')}}" ></script>
@endif

{{--withdrawal--}}
@php $pageWithdrawalArray = ['show_all_withdrawals', 'show_withdrawals_with_conditions'];  @endphp
@if(@in_array( request()->segment(1), $pageWithdrawalArray))
    <script src="{{asset('js/custom/withdrawals.js')}}" ></script>
@endif

{{--pages that need the country drop down--}}
@php $pageCountryArray = ['edit_centers','editProfile', 'create_center_page', 'edit_center_page'];  @endphp
@if(@in_array( request()->segment(1), $pageCountryArray))
    <script src="{{asset('js/custom/country.js')}}" ></script>
    <script>
        let selCountry = $("#countryHolder").val();
        var count = getCountries(selCountry);
        $('#country').html(count);
    </script>
@endif

<!--faqs pages-->
@php $faqsPages = ['create_faqs_page', 'view_fags']; @endphp
@php $currentPageName = Request::segment(1); @endphp
@if(in_array($currentPageName, $faqsPages))
    <script src="{{asset('js/custom/faqs.js')}}" ></script>
@endif

<!--news pages-->
@php $newsPages = ['view_all_news']; @endphp
@php $currentPageName = Request::segment(1); @endphp
@if(in_array($currentPageName, $newsPages))
    <script src="{{asset('js/custom/news.js')}}" ></script>
@endif

<!--bank-->
@php $dataBankPages = ['main_settings_page']; @endphp
@php $currentPageName = Request::segment(1); @endphp
@if(in_array($currentPageName, $dataBankPages))
    <script src="{{asset('js/banks.js')}}"></script>
    <script src="{{asset('js/custom/bank.js')}}"></script>
@endif

<!--testimonies-->
@php $dataTestimonyPages = ['view_testimonies']; @endphp
@php $currentPageName = Request::segment(1); @endphp
@if(in_array($currentPageName, $dataTestimonyPages))
    <script src="{{asset('js/custom/testimony.js')}}"></script>
@endif

<!--investments-->
@php $dataTestimonyPages = ['investments_settings', 'view_investments', 'view_investment_plan', 'create_investment_interface', 'edit_investment_settings_page', 'view_due_investments']; @endphp
@php $currentPageName = Request::segment(1); @endphp
@if(in_array($currentPageName, $dataTestimonyPages))
    <script src="{{asset('js/custom/investment_settings.js')}}"></script>
@endif

<style>
    label, label > select, label > input, #myTable_info{
        color:white !important
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active {
        cursor: default;
        color: #fff !important;
        border: 1px solid transparent;
        background: transparent;
        box-shadow: none;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        box-sizing: border-box;
        display: inline-block;
        min-width: 1.5em;
        padding: 0.5em 1em;
        margin-left: 2px;
        text-align: center;
        text-decoration: none !important;
        cursor: pointer;
        *cursor: hand;
        color: #fff !important;
        border: 1px solid transparent;
        border-radius: 2px;
    }
</style>