
<!--================Header Area =================-->
<header class="header_area navbar_fixed d-none d-lg-block " style="position:fixed">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <!-- Brand and toggle get grouped for better mobile display -->
            <a class="navbar-brand logo_h" href="index.html"><img src="{{asset('images/balai-logo.jpg')}}" style="width:50px; height:50px;" alt=""></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                <ul class="nav navbar-nav menu_nav ml-auto">
                    <li class="nav-item active"><a class="nav-link" href="{{url('/')}}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('chatlist')}}">Message</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('chatlist')}}">About Us</a></li>
                    <!-- User Icon with Dropdown and Circular Border -->
                    <li class="nav-item submenu dropdown">
                        <a href="#" class="nav-link dropdown-toggle user-icon" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-user"></i>
                        </a>
                        <ul class="dropdown-menu">
                            @if (Auth::check())
                                <li class="nav-item p-3" style="padding-left: 10%">
                                    <strong style="font-weight: bold">{{ Auth::user()->name }}</strong><br>
                                    <span>{{ Auth::user()->email }}</span>
                                </li>

                                <li class="nav-item"><a class="nav-link" href="">Profile</a></li>
                                @if (Auth::user()->role === 'user')
                                    <li class="nav-item"><a class="nav-link" href="{{ route('user.mybooking') }}">My Booking</a></li>
                                @endif
                                @if (Auth::user()->role === 'resort')
                                    <li class="nav-item"><a class="nav-link" href="{{ route('resort.dashboard') }}">Dashboard</a></li>


                                @endif

                                <li class="nav-item"><a class="nav-link" href="{{ route('logout') }}">Logout</a></li>
                            @else
                                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                            @endif
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>


<!-- Mobile Navbar -->
<nav class="navbar fixed-bottom navbar-light bg-light d-block d-lg-none">
    <ul class="nav justify-content-around w-100">
        <li class="nav-item text-center">
            <a href="index.html" class="nav-link text-black">
                <i class="fa fa-home" style="color: black;"></i>
                <div style="font-size: 12px; color: black;">Home</div>
            </a>
        </li>
        <li class="nav-item text-center">
            <a href="messages.html" class="nav-link text-black">
                <i class="fa fa-envelope" style="color: black;"></i>
                <div style="font-size: 12px; color: black;">Message</div>
            </a>
        </li>
        <li class="nav-item text-center">
            <a href="about.html" class="nav-link text-black">
                <i class="fa fa-info-circle" style="color: black;"></i>
                <div style="font-size: 12px; color: black;">About Us</div>
            </a>
        </li>
        <li class="nav-item text-center">
            <a href="profile.html" class="nav-link text-black">
                <i class="fa fa-user" style="color: black;"></i>
                <div style="font-size: 12px; color: black;">Me</div>
            </a>
        </li>
    </ul>
</nav>

<!--================Header Area =================-->
