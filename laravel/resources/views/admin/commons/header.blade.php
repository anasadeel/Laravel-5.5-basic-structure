<!-- Main Header -->
<header class="main-header">
    <!-- Logo -->
    <a href="{{ url('admin') }}" class="logo" style="background-color: #203b51;">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">
            <img src="{{asset('front/images/favicon.jpg')}}" class="img-circle" alt="logo" style="width: 100%;">   
        </span>
        <!-- logo for regular state and mobile devices -->
<!--        <span class="logo-lg"><b>Admin</b> {{Config::get('params.site_name')}}</span>-->
        <span class="logo-lg"><b><img src="{{asset('front/images/noimage.jpg')}} " style="width:50px;"></b></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- The user image in the navbar-->
                        @if(Auth::user()->image == '')
                        <img src="{{ asset('front/images/noimage.jpg')}}" class="user-image" alt="User Image">
                        @else
                        <img src="{{ asset('uploads/users/profile/'. Auth::user()->image)}}" class="user-image" alt="User Image">
                        @endif
                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <span class="hidden-xs">{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}</span>
                    </a>
<!--                    <ul class="dropdown-menu">
                        <li class="user-header">
                            @if(Auth::user()->image == '')
                            <img src="{{ asset('front/images/noimage.jpg')}}" class="img-circle" alt="User Image">
                            @else
                            <img src="{{ asset('uploads/users/profile/'. Auth::user()->image)}}" class="img-circle" alt="User Image">
                            @endif

                            <p>
                                {{ Auth::user()->firstName }} {{ Auth::user()->lastName }}
                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-right">
                                <a href="{{ url('/auth/logout') }}" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>-->
<ul class="dropdown-menu menu-arrow">

                        <li class="user-header">
                            @if(Auth::user()->image == '')
                            <img src="{{ asset('front/images/noimage.jpg')}}" class="img-circle" alt="User Image">
                            @else
                            <img src="{{ asset('uploads/users/profile/'. Auth::user()->image)}}" class="img-circle" alt="User Image">
                            @endif
                            <div class="user-name__name1">
                                <span class="hidden-xs name1">{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}</span><br>
                                <small>Member since {{ date_format(Auth::user()->created_at, 'M. j Y') }}</small>
                            </div>
                        </li>

                        <li>
                            <a href="{{ url('admin/dashboard') }}">Dashboard</a>
                        </li>
<!--                        <li>
                            <a href="{{ url('admin/profile') }}" >Edit Profile</a>
                        </li>                       -->
                        <li>
                           <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                Sign out
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>

                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->

            </ul>
        </div>
    </nav>
</header>
