@php $AppSettingsModel = new \App\Models\AppSettings(); @endphp
@php $AppSettings = $AppSettingsModel->getSingleModel() @endphp
<div class="ecaps-sidemenu-area">
    <!-- Desktop Logo -->
    <div class="ecaps-logo">
        <a href="/">
            <img class="desktop-logo img-responsive" src="{{$AppSettings->logo_url}}" alt="{{env('APP_NAME', 'EFFICIENT')}}">
            <img class="small-logo img-responsive" src="{{$AppSettings->logo_url}}" alt="{{env('APP_NAME', 'EFFICIENT')}}">
        </a>
    </div>

    <!-- Side Nav -->
    <div class="ecaps-sidenav" id="ecapsSideNav">
        <!-- Side Menu Area -->
        <div class="side-menu-area">
            <!-- Sidebar Menu -->
            <nav>
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="active">
                        <a href="{{route('home')}}"><i class='bx bx-home-heart'></i><span>Dashboard</span></a>
                    </li>


                    <li>
                        <a href="{{route('view_support', [auth()->user()->type_of_user === 'user'? auth()->user()->unique_id : ''])}}" class="notifier_class" >
                            <i class='bx bx-support'></i><span>Support</span>
                        </a>
                    </li>


                </ul>
            </nav>
        </div>
    </div>
</div>

@section('sideBarScript')

    @endsection