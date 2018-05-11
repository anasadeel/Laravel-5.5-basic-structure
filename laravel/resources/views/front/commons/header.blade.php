<!-- Main Header -->
<header class="main-header main-header__styling">
    <!-- Logo -->
    <a href="{{ url('/') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">
            <img src="{{asset('front/images/favicon.png')}}" class="img-circle" alt="logo" style="width: 100%;">
            <!--             @if(Auth::user()->image == '')
                        <img src="{{ asset('front/images/noimage.jpg')}}" class="img-circle" alt="logo" style="width: 100%;">
                        @else
                        <img src="{{ asset('uploads/users/profile/'. Auth::user()->image)}}" class="img-circle" alt="logo" style="width: 100%;">
                        @endif -->
        </span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b><img src="{{asset('front/images/logo.png')}} " style="width:160px;"></b></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        @if(Auth::user()->role->code == 'paid')
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        @endif

        <!-- Navbar Right Menu -->

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav ">

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
                        <span>{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}</span>
                    <!--         <i class="fa fa-caret-down" aria-hidden="true"></i> -->
                    </a>
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
                            <a href="{{ url('dashboard') }}">Dashboard</a>
                        </li>
                        <li>
                            <a href="{{ url('profile') }}" >Edit Profile</a>
                        </li>                       
                        <li>
                            <a href="{{ url('subscription') }}" class="">Account Setting</a>
                        </li>
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


        </span>

    </nav>
</header>
