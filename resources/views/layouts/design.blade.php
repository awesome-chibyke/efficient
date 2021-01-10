<!doctype html>
<html lang="en">

@include('layouts.head')

<body class="vertical-dark">

<!-- Preloader -->
<div id="preloader"></div>

@include('layouts.modal')

<!-- ======================================
******* Page Wrapper Area Start **********
======================================= -->
<div class="ecaps-page-wrapper">
    <!-- Sidemenu Area -->
    @include('layouts.sidemenu')

    <!-- Page Content -->
    <div class="ecaps-page-content">
        <!-- Top Header Area -->
        @include('layouts.header')

        <!-- Main Content Area -->
        <div class="main-content">
        @yield('content')

            <!-- Footer Area -->
            @include('layouts.footer')
        </div>
    </div>
</div>

<!-- ======================================
********* Page Wrapper Area End ***********
======================================= -->

<!-- Must needed plugins to the run this Template -->
@include('layouts.e_script')

@yield('sideBarScript')

</body>

</html>