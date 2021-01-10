<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<div class="left-sidebar-pro">
    <nav id="sidebar" class="">
        <div class="sidebar-header">
            <a href="index.html"><img class="main-logo" src="img/logo/logo.png" alt="" /></a>
            <strong><img src="img/logo/logosn.png" alt="" /></strong>
        </div>
        <div class="nalika-profile">
            <div class="profile-dtl">
                @php $link = auth()->user()->returnLink(); @endphp

                <a href="#">
                    <img src="{{asset((auth()->user()->profile_image === null) ? 'img/alt_image.png' : $link.'users/'.auth()->user()->profile_image)}}" alt="{{env('APP_NAME', 'LARAVEL')}}" class="img-circle circle-border m-b-md" style="max-width: 100px;" />
                    {{--<img src="{{asset('mdash/img/notification/4.jpg')}}" alt="" />--}}
                </a>
                <h2>{{auth()->user()->name}} {{--<span class="min-dtn">Das</span>--}}</h2>
            </div>
            {{--<div class="profile-social-dtl">
                <ul class="dtl-social">
                    <li><a href="#"><i class="icon nalika-facebook"></i></a></li>
                    <li><a href="#"><i class="icon nalika-twitter"></i></a></li>
                    <li><a href="#"><i class="icon nalika-linkedin"></i></a></li>
                </ul>
            </div>--}}
        </div>
        <div class="left-custom-menu-adp-wrap comment-scrollbar">
            <nav class="sidebar-nav left-sidebar-menu-pro">
                <ul class="metismenu" id="menu1">

                    <li>
                        <a href="{{route('home')}}" aria-expanded="false"><i class="icon nalika-home icon-wrap"></i> <span class="mini-click-non">Dashboard</span></a>
                    </li>

                    @if(auth()->user()->privilegeChecker('view_all_users_list'))
                    <li class="{{@$active === 'users' ? 'active':''}}">
                        <a class="has-arrow" href="javascript:;" aria-expanded="false"><i class="icon nalika-user icon-wrap"></i> <span class="mini-click-non">Users</span></a>
                        <ul class="submenu-angle" aria-expanded="false">
                            @if(auth()->user()->privilegeChecker('view_users'))
                            <li><a href="{{route('all_users')}}"><span class="mini-sub-pro">Users</span></a></li>
                            @endif
                            @if(auth()->user()->privilegeChecker('view_admin'))
                            <li><a href="{{route('all_admin')}}"><span class="mini-sub-pro">Admins</span></a></li>
                            @endif
                            @if(auth()->user()->privilegeChecker('view_super_admin'))
                            <li><a href="{{route('all_super_admin')}}"><span class="mini-sub-pro">Super Admins</span></a></li>
                            @endif

                        </ul>
                    </li>
                    @endif

                    @if(auth()->user()->privilegeChecker('view_profile'))
                    <li class="{{@$active === 'profile' ? 'active':''}}">
                        <a class="has-arrow" href="javascript:;" aria-expanded="false"><i class="icon nalika-user icon-wrap"></i> <span class="mini-click-non">Profile</span></a>
                        <ul class="submenu-angle" aria-expanded="false">
                            <li><a href="{{route('profile')}}"><span class="mini-sub-pro">View Profile</span></a></li>
                            <li><a href="{{route('editProfile')}}"><span class="mini-sub-pro">Edit Profile</span></a></li>
                            <li><a href="{{route('account_validation', [auth()->user()->unique_id])}}"><span class="mini-sub-pro">Account Details</span></a></li>

                        </ul>
                    </li>
                    @endif

                    @if(auth()->user()->privilegeChecker('view_user_wallet'))
                    <li class="{{@$active === 'wallet' ? 'active':''}}">
                        <a class="has-arrow" href="javascript:;" aria-expanded="false"><i class="icon nalika-mastercard icon-wrap"></i> <span class="mini-click-non">Wallet</span></a>
                        <ul class="submenu-angle" aria-expanded="false">
                            <li><a href="{{route('wallet', [auth()->user()->unique_id])}}"><span class="mini-sub-pro">My Wallet</span></a></li>
                            <li><a href="{{route('confirmed_wallet', [auth()->user()->unique_id])}}"><span class="mini-sub-pro">Top Up history</span></a></li>
                            <li><a href="{{route('charge', [auth()->user()->unique_id])}}"><span class="mini-sub-pro">Investment Charges</span></a></li>

                        </ul>
                    </li>
                    @endif


                    @if(auth()->user()->privilegeChecker('view_all_transactions'))
                        <li class="{{@$active === 'wallet' ? 'active':''}} {{@$active === 'withdrawals' ? 'active':''}}">
                            <a class="has-arrow" href="javascript:;" aria-expanded="false"><i class="icon nalika-mastercard icon-wrap"></i> <span class="mini-click-non">Transactions</span></a>
                            <ul class="submenu-angle" aria-expanded="false">
                                <li><a href="{{route('wallet')}}"><span class="mini-sub-pro">Pending Top Ups</span></a></li>
                                <li><a href="{{route('confirmed_wallet')}}"><span class="mini-sub-pro">Top Up history</span></a></li>
                                <li><a href="{{route('charge')}}"><span class="mini-sub-pro">Investment Charges</span></a></li>
                                <li><a href="{{route('show_all_withdrawals')}}"><span class="mini-sub-pro">Pending Withdrawals</span></a></li>
                                <li><a href="{{route('show_all_confirmed_withdrawals')}}"><span class="mini-sub-pro">Withdrawal History</span></a></li>

                            </ul>
                        </li>
                    @endif


                    <li class="{{@$active === 'investments' ? 'active':''}}">
                        <a class="has-arrow" href="javascript:;" aria-expanded="false"><i class="icon nalika-mastercard icon-wrap"></i> <span class="mini-click-non">Investments</span></a>
                        <ul class="submenu-angle" aria-expanded="false">
                            @if(auth()->user()->privilegeChecker('user_investments'))
                            <li><a href="{{route('create_investment_interface')}}"><span class="mini-sub-pro">Create Investment</span></a></li>
                            <li><a href="{{route('view_investment_plan')}}"><span class="mini-sub-pro">View Investments</span></a></li>
                            @endif
                            @if(auth()->user()->privilegeChecker('investments'))
                            <li><a href="{{route('investments_settings')}}"><span class="mini-sub-pro">New Package</span></a></li>
                            <li><a href="{{route('view_investment_plan')}}"><span class="mini-sub-pro">View Investments</span></a></li>
                            @endif

                        </ul>
                    </li>


                    @if(auth()->user()->privilegeChecker('gallery'))
                        <li class="{{@$active === 'gallery' ? 'active':''}}">
                            <a class="has-arrow" href="javascript:;" aria-expanded="false"><i class="icon nalika-picture icon-wrap"></i> <span class="mini-click-non">Gallery</span></a>
                            <ul class="submenu-angle" aria-expanded="false">
                                <li><a href="{{route('create_gallery_view')}}"><span class="mini-sub-pro">Add New Event</span></a></li>
                                <li><a href="{{route('view_gallery_events')}}"><span class="mini-sub-pro">View Events</span></a></li>

                            </ul>
                        </li>
                    @endif

                    @if(auth()->user()->privilegeChecker('news'))
                        <li class="{{@$active === 'news' ? 'active':''}}">
                            <a class="has-arrow" href="javascript:;" aria-expanded="false"><i class="icon nalika-new-file icon-wrap"></i> <span class="mini-click-non">News</span></a>
                            <ul class="submenu-angle" aria-expanded="false">
                                <li><a href="{{route('create_news_view')}}"><span class="mini-sub-pro">Create News</span></a></li>
                                <li><a href="{{route('view_all_news')}}"><span class="mini-sub-pro">View All News</span></a></li>
                            </ul>
                        </li>
                    @endif

                    @if(auth()->user()->privilegeChecker('faqs'))
                        <li class="{{@$active === 'faqs' ? 'active':''}}">
                            <a class="has-arrow" href="javascript:;" aria-expanded="false"><i class="icon nalika-info icon-wrap"></i> <span class="mini-click-non">Faqs</span></a>
                            <ul class="submenu-angle" aria-expanded="false">
                                <li><a href="{{route('create_faqs_page')}}"><span class="mini-sub-pro">Create Faqs</span></a></li>
                                <li><a href="{{route('view_fags')}}"><span class="mini-sub-pro">View Faqs</span></a></li>

                            </ul>
                        </li>
                    @endif

                    @if(auth()->user()->privilegeChecker('view_user_withdrawal'))
                    <li class="{{@$active === 'withdrawals' ? 'active':''}}">
                        <a class="has-arrow" href="javascript:;" aria-expanded="false"><i class="icon nalika-mastercard icon-wrap"></i> <span class="mini-click-non">Withdrawals</span></a>
                        <ul class="submenu-angle" aria-expanded="false">
                            <li><a href="{{route('show_all_withdrawals', [auth()->user()->unique_id])}}"><span class="mini-sub-pro">Requests</a></li></li>
                            <li><a href="{{route('show_all_confirmed_withdrawals', [auth()->user()->unique_id])}}"><span class="mini-sub-pro">History</span></a></li>
                        </ul>
                    </li>
                    @endif

                    @if(auth()->user()->privilegeChecker('view_roles'))
                    <li class="{{@$active === 'roles' ? 'active':''}}">
                        <a class="has-arrow" href="javascript:;" aria-expanded="false"><i class="icon nalika-smartphone-call icon-wrap"></i> <span class="mini-click-non">Roles</span></a>
                        <ul class="submenu-angle" aria-expanded="false">
                            <li><a href="{{route('add_roles')}}"><span class="mini-sub-pro">Add New Roles</span></a></li>
                            <li><a href="{{route('add_user_type')}}"><span class="mini-sub-pro">Add User type</span></a></li>
                            <li><a href="{{route('view_all_roles')}}"><span class="mini-sub-pro">View Roles</span></a></li>
                            <li><a href="{{route('all_user_type')}}"><span class="mini-sub-pro">View User Types</span></a></li>
                        </ul>
                    </li>
                    @endif

                    <li class="{{@$active === 'support' ? 'active':''}}">
                        <a class="has-arrow notifier_class" href="javascript:;" aria-expanded="false">
                            <i class="icon nalika-chat icon-wrap"></i> <span class="mini-click-non">Support <sup class="badge-info badge" style="color:white;">0</sup></span>
                        </a>
                        <ul class="submenu-angle" aria-expanded="false">
                            <li><a target="_blank" href="{{route('view_support', [auth()->user()->type_of_user === 'user' ? auth()->user()->unique_id :'' ])}}"><span class="mini-sub-pro">Support</span></a></li>
                        </ul>
                    </li>

                    <li class="{{@$active === 'testimony' ? 'active':''}}">
                        <a class="has-arrow" href="javascript:;" aria-expanded="false"><i class="icon nalika-chat icon-wrap"></i> <span class="mini-click-non">Testimonies</span></a>
                        <ul class="submenu-angle" aria-expanded="false">
                            <li><a onclick="bringOutModalMain('.testmony-update')" href="javascript:;"><span class="mini-sub-pro">Add Testimony</span></a></li>
                            @if(auth()->user()->privilegeChecker('testimony_view'))
                            <li><a href="{{route('view_testimonies')}}"><span class="mini-sub-pro">View Testimonies</span></a></li>
                            @endif
                        </ul>
                    </li>


                    <li class="{{@$active === 'settings' ? 'active':''}}">
                        <a class="has-arrow" href="javascript:;" aria-expanded="false"><i class="icon nalika-settings icon-wrap"></i> <span class="mini-click-non">Settings</span></a>
                        <ul class="submenu-angle" aria-expanded="false">
                            <li><a href="{{route('settings_page')}}"><span class="mini-sub-pro">Settings</span></a></li>
                            @if(auth()->user()->privilegeChecker('bank_details'))
                            <li><a href="{{route('getAccountDetails')}}"><span class="mini-sub-pro">Bank Details</span></a></li>
                            @endif
                            @if(auth()->user()->privilegeChecker('main_settings'))
                            <li><a href="{{route('main_settings_page')}}"><span class="mini-sub-pro">Main Settings</span></a></li>
                            @endif
                        </ul>
                    </li>


                    <li style="margin-bottom: 200px;">
                        <a class="has-arrow" href="javascript:;" aria-expanded="false"><i class="icon nalika-refresh-button icon-wrap"></i> <span class="mini-click-non">Logout</span></a>
                        <ul class="submenu-angle" aria-expanded="false">
                            <li><a href="javascript:;" onclick="logoutFuntion()"><span class="mini-sub-pro">Logout</span></a></li>
                        </ul>
                    </li>

                </ul>
            </nav>
        </div>
    </nav>
</div>