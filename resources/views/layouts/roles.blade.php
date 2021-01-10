<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    {{--<link rel="stylesheet" href="{{ mix('css/app.css') }}">--}}
    <link rel="stylesheet" href="{{asset('adopted/css/bootstrap.min.css')}}">


    <!-- Scripts -->
    {{--<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.js" defer></script>--}}
</head>
<body>
<div class="font-sans text-gray-900 antialiased">
    {{ $slot }}
</div>
</body>
<!-- Scripts -->
<script src="{{asset('js/custom/jquery.js')}}" ></script>
{{--<script src="{{asset('adopted/js/bootstrap.min.js')}}" ></script>--}}
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
<script src="{{asset('js/custom/generics.js')}}" ></script>
<script src="{{asset('js/custom/roles_js.js')}}" ></script>
<script src="{{asset('js/custom/requestHandler.js')}}" ></script>

<!--sweet alert-->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!--datatables-->
@php $dataTablePages = ['view_all_roles', 'all_user_type', 'add_role_for_user']; @endphp
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

</html>
