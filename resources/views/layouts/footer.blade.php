@php $app_settings = new \App\Models\AppSettings(); @endphp
@php $settings = $app_settings->getSingleModel(); @endphp
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Footer Area -->
            <footer class="footer-area d-sm-flex justify-content-center align-items-center justify-content-between text-center">
                <!-- Copywrite Text -->
                <div class="copywrite-text text-center">
                    <p class="font-13"> © All Rights Reserved @php $d=date('Y'); print $d;@endphp - {{$settings->site_name}}</p>
                </div>
            </footer>
        </div>
    </div>
</div>
<style>
    a.page-link {
        color: black !important;
    }
    .dataTables_info{
        color: #000 !important;
    }
</style>