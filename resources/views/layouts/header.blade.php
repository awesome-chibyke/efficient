<header class="top-header-area d-flex align-items-center justify-content-between">
    <div class="left-side-content-area d-flex align-items-center">
        <!-- Mobile Logo -->
        <div class="mobile-logo mr-3 mr-sm-4">
            <a href="/">
                <img src="{{asset((auth()->user()->profile_image === null) ? 'img/alt_image.png' : 'storage/img/users/'.auth()->user()->profile_image) }}" alt="{{env('APP_NAME', 'EFFICIENT')}}">
            </a>
        </div>

        <!-- Triggers -->
        <div class="ecaps-triggers mr-1 mr-sm-3">
            <div class="menu-collasped" id="menuCollasped">
                <i class='bx bx-menu'></i>
            </div>
            <div class="mobile-menu-open" id="mobileMenuOpen">
                <i class='bx bx-menu'></i>
            </div>
        </div>

        <!-- Left Side Nav -->
        <ul class="left-side-navbar d-flex align-items-center">
            <li class="hide-phone app-search">
                <h5 class="loggedInName"></h5>
            </li>
        </ul>
    </div>

    <div class="right-side-navbar d-flex align-items-center justify-content-end">
        <!-- Mobile Trigger -->
        <div class="right-side-trigger" id="rightSideTrigger">
            <i class='bx bx-menu-alt-right'></i>
        </div>

        <!-- Top Bar Nav -->
        <ul class="right-side-content d-flex align-items-center">

            <!-- Full Screen Mode -->
            <li class="full-screen-mode ml-1">
                <a href="javascript:" id="fullScreenMode"><i class='bx bx-exit-fullscreen'></i></a>
            </li>

           {{-- <li class="nav-item dropdown">
                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="bx bx-bell bx-tada"></i> <span class="active-status"></span></button>
                <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-203px, 26px, 0px);">
                    <!-- Top Notifications Area -->
                    <div class="top-notifications-area">
                        <!-- Heading -->
                        <div class="notifications-heading">
                            <div class="heading-title">
                                <h6>Notifications</h6>
                            </div>
                            <span>07 New</span>
                        </div>

                        <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 260px;"><div class="notifications-box" id="notificationsBox" style="overflow: hidden; width: auto; height: 260px;">
                                <a href="#" class="dropdown-item">
                                    <i class="bx bx-shopping-bag"></i>
                                    <div>
                                        <span>Your order is placed</span>
                                        <p class="mb-0 font-12">Consectetur adipisicing elit. Ipsa, porro!</p>
                                    </div>
                                </a>

                                <a href="#" class="dropdown-item">
                                    <img src="img/member-img/mail-1.jpg" alt="">
                                    <div>
                                        <span>Haslina Obeta</span>
                                        <p class="mb-0 font-12">Consectetur adipisicing elit. Ipsa, porro!</p>
                                    </div>
                                </a>

                                <a href="#" class="dropdown-item">
                                    <i class="bx bx-atom bg-success"></i>
                                    <div>
                                        <span>Your order is Dollar</span>
                                        <p class="mb-0 font-12">Consectetur adipisicing elit. Ipsa, porro!</p>
                                    </div>
                                </a>

                                <a href="#" class="dropdown-item">
                                    <img src="img/member-img/mail-3.jpg" alt="">
                                    <div>
                                        <span>Your order is placed</span>
                                        <p class="mb-0 font-12">Consectetur adipisicing elit. Ipsa, porro!</p>
                                    </div>
                                </a>
                            </div><div class="slimScrollBar" style="background: rgb(140, 140, 140) none repeat scroll 0% 0%; width: 2px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 0px; height: 177.895px;"></div><div class="slimScrollRail" style="width: 2px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51) none repeat scroll 0% 0%; opacity: 0.2; z-index: 90; right: 0px;"></div></div>
                    </div>
                </div>
            </li>--}}

            <li class="nav-item dropdown">
                @php $link = auth()->user()->returnLink(); @endphp
                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="{{asset((auth()->user()->profile_image === null) ? 'img/alt_image.png' : $link.'users/'.auth()->user()->profile_image)}}" alt="{{env('APP_NAME', 'EFFICIENT')}}">
                </button>
                <div class="dropdown-menu profile dropdown-menu-right">
                    <!-- User Profile Area -->
                    <div class="user-profile-area">
                        <a href="{{route('profile')}}" class="dropdown-item"><i class="bx bx-user font-15" aria-hidden="true"></i> My profile</a>
                        <a href="/" class="dropdown-item"><i class="bx bx-wrench font-15" aria-hidden="true"></i> settings</a>
                        <a href="javascript:void(0)" class="dropdown-item" onclick="bringOutModalMain('.logout')">
                            <i class="bx bx-power-off font-15" aria-hidden="true"></i>
                            {{ __('Logout') }}
                        </a>

                    </div>
                </div>
            </li>
        </ul>
    </div>
</header>