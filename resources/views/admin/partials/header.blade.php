<!-- resources/views/admin/partials/header.blade.php -->
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="nav-wrap">
        <div class="mobile-only-brand pull-left">
            <div class="nav-header pull-left">
                <div class="logo-wrap">
                    <a href="{{ url('/admin/dashboard') }}">
                        <img class="brand-img" src="{{ asset('img/brand-imbos.png') }}" alt="brand"/>
                        <span class="brand-text"><img src="{{ asset('img/brand-imbos.png') }}" alt="brand"/></span>
                    </a>
                </div>
            </div>    
            <a id="toggle_nav_btn" class="toggle-left-nav-btn inline-block ml-20 pull-left" href="javascript:void(0);"><i class="zmdi zmdi-menu"></i></a>
            <a id="toggle_mobile_nav" class="mobile-only-view" href="javascript:void(0);"><i class="zmdi zmdi-more"></i></a>
        </div>
        <div id="mobile_only_nav" class="mobile-only-nav pull-right">
            <ul class="nav navbar-right top-nav pull-right">
                {{-- <li class="dropdown alert-drp">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="zmdi zmdi-notifications top-nav-icon"></i><span class="top-nav-icon-badge"></span></a>
                    <ul class="dropdown-menu alert-dropdown" data-dropdown-in="bounceIn" data-dropdown-out="bounceOut">
                        <li>
                            <div class="notification-box-head-wrap">
                                <span class="notification-box-head pull-left inline-block">notifications</span>
                                <a class="txt-danger pull-right clear-notifications inline-block" href="javascript:void(0)"> clear all </a>
                                <div class="clearfix"></div>
                                <hr class="light-grey-hr ma-0"/>
                            </div>
                        </li>
                        <li>
                            <div class="streamline message-nicescroll-bar">
                                <!-- Notification Items Here -->
                            </div>
                        </li>
                        <li>
                            <div class="notification-box-bottom-wrap">
                                <hr class="light-grey-hr ma-0"/>
                                <a class="block text-center read-all" href="javascript:void(0)"> read all </a>
                                <div class="clearfix"></div>
                            </div>
                        </li>
                    </ul>
                </li> --}}
                {{-- <li>
                    <a id="open_right_sidebar" href="#"><i class="zmdi zmdi-settings  top-nav-icon"></i></a>
                </li> --}}
                <li class="dropdown auth-drp">
                    {{-- <a href="#" class="dropdown-toggle pr-0" data-toggle="dropdown"><img src="{{ asset('img/user1.png') }}" alt="user_auth" class="user-auth-img img-circle"/><span class="user-online-status"></span><span class="user-auth-name inline-block">micheal hogan <span class="ti-angle-down"></span></span></a> --}}
                    <a href="#" class="dropdown-toggle pr-0" data-toggle="dropdown">
                        @if(Auth::guard('admin')->check())
                            <img src="{{ asset('storage/' . Auth::guard('admin')->user()->foto) }}" alt="user_auth" class="user-auth-img img-circle"/>
                            <span class="user-online-status"></span>
                            <span class="user-auth-name inline-block">{{ Auth::guard('admin')->user()->name }} <span class="ti-angle-down"></span></span>
                        @else
                            <img src="{{ asset('img/user1.png') }}" alt="user_auth" class="user-auth-img img-circle"/>
                            <span class="user-online-status"></span>
                            <span class="user-auth-name inline-block">Guest <span class="ti-angle-down"></span></span>
                        @endif
                    </a>
                    <ul class="dropdown-menu user-auth-dropdown" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
                        <li>
                            <a href="{{ route('admin.profile.edit') }}"><i class="zmdi zmdi-account"></i><span>Profile</span></a>
                        </li>
                        {{-- <li>
                            <a href="#"><i class="zmdi zmdi-card"></i><span>my balance</span></a>
                        </li>
                        <li>
                            <a href="inbox.html"><i class="zmdi zmdi-email"></i><span>Inbox</span></a>
                        </li>
                        <li>
                            <a href="#"><i class="zmdi zmdi-settings"></i><span>Settings</span></a>
                        </li> --}}
                        {{-- <li class="divider"></li>
                        <li class="sub-menu show-on-hover">
                            <a href="#" class="dropdown-toggle pr-0 level-2-drp"><i class="zmdi zmdi-check text-success"></i> available</a>
                            <ul class="dropdown-menu open-left-side">
                                <li>
                                    <a href="#"><i class="zmdi zmdi-check text-success"></i><span>available</span></a>
                                </li>
                                <li>
                                    <a href="#"><i class="zmdi zmdi-circle-o text-warning"></i><span>busy</span></a>
                                </li>
                                <li>
                                    <a href="#"><i class="zmdi zmdi-minus-circle-outline text-danger"></i><span>offline</span></a>
                                </li>
                            </ul>    
                        </li> --}}
                        <li class="divider"></li>
                        <li>
                            <a href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="zmdi zmdi-power"></i><span>Log Out</span>
                            </a>
                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>    
    </div>
</nav>
