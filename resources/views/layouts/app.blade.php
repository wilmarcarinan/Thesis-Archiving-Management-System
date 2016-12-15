<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>
    <link rel="icon" href="../book.ico"/>

    <!-- Styles -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link href="/css/app.css" rel="stylesheet">

    <!-- Scripts -->
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script type="text/javascript" src="../js/scripts.js"></script>
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    @if(! Auth::guest())
        @if(Auth::user()->Role == 'Admin')
            <link rel="stylesheet" href="/css/admin.css">
        @endif
    @endif
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    {{-- <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button> --}}

                    <!-- Branding Image -->
                    
                    <a class="navbar-brand" href="{{ url('/home') }}">
                        <span>
                            <img src="../img/tup.png" height="30px" width="30px">
                        </span>
                        &nbsp;
                        {{ config('app.name') }}
                    </a>
{{--                     <a class="navbar-brand" href="#">About Us</a>
                    <a class="navbar-brand" href="#">Contact Us</a> --}}
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li>
                                <a href="{{ url('/login') }}">
                                    <span class="glyphicon glyphicon-log-in"></span>
                                    Login
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/register') }}">
                                    <span class="glyphicon glyphicon-user"></span>
                                    Register
                                </a>
                            </li>
                        @else
                            <li>
                                <a href="/search"><span class="glyphicon glyphicon-search"></span> Search</a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->FirstName }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    @if(! Auth::user()->Role == 'Admin')
                                        <li>
                                            <a href="/settings">Settings</a>
                                        </li>
                                    @endif
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
            @if(!Auth::guest())
                @if(Auth::user()->Role == 'Admin')
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav side-nav">
                        <li>
                            <a href="/AdminPage">Dashboard</a>
                        </li>
                        <li>
                            <a href="#">Manage Users</a>
                        </li>
                        <li>
                            <a href="#">Manage Files</a>
                        </li>
                        <li>
                            <a href="#">Logs</a>
                        </li>
                        <li>
                            <a href="#">Reports</a>
                        </li>
                        <li>
                            <a href="/settings">Admin Settings</a>
                        </li>
                    </ul>
                </div>
                @endif
            @endif
        </nav>

        @yield('content')
        @yield('footer')
    </div>

    <!-- Scripts -->
    <script src="/js/app.js"></script>
</body>
</html>
