<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{csrf_token()}}">

    <title>{{ config('app.name') }}</title>
    <link rel="icon" href="../book.ico"/>

    <!-- Styles -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link href="/css/app.css" rel="stylesheet">

    <!-- Scripts -->
    {{-- <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/jquery.min.js"></script> --}}

    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    @if(! Auth::guest())
        @if(Auth::user()->Role == 'Admin')
            <link rel="stylesheet" href="/css/admin.css">
        @else
            <link rel="stylesheet" href="/css/style.css">
        @endif
    @endif
</head>
<body>
    <div id="app">
        {{-- <nav class="navbar navbar-default navbar-static-top"> --}}
        <nav class="navbar navbar-inverse navbar-static-top">
            <div class="container-fluid">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    {{-- <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button> --}}

                    <!-- Branding Image -->
                    @if (Auth::guest())
                        <a href="{{ url('/register') }}" class="navbar-toggle">
                            <span class="glyphicon glyphicon-user"></span>
                        </a>

                        <a href="{{ url('/login') }}" class="navbar-toggle">
                            <span class="glyphicon glyphicon-log-in"></span>
                        </a>
                    @else
                    
                        @if(Auth::user()->Role == 'User')
                            <a href="/settings" class="navbar-toggle">
                                <span class="glyphicon glyphicon-cog"></span>
                            </a>
                        @endif
                            <a href="{{ url('/logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();" class="navbar-toggle">
                                <span class="glyphicon glyphicon-off"></span>
                            </a>
                            <a href="/list" class="navbar-toggle ">
                                <span class="glyphicon glyphicon-list-alt"></span>                        
                            </a>
                            <a href="/collections" class="navbar-toggle">
                                <span class="glyphicon glyphicon-th-large"></span>                
                            </a>
                            <a href="/search" class="navbar-toggle">
                                <span class="glyphicon glyphicon-search"></span>                        
                            </a>
                            <a href="/home" class="navbar-toggle">
                                <span class="glyphicon glyphicon-home"></span>                        
                            </a>
                    @endif
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <a class="navbar-brand" href="{{ url('/home') }}">
                        <span>
                            <img src="../../img/tup.png" height="30px" width="30px">
                        </span>
                        &nbsp;
                        {{ config('app.name') }}
                    </a>

                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            @if(Request::path() == 'login')
                                <li class="active">
                            @else
                                <li>
                            @endif
                                <a href="{{ url('/login') }}">
                                    <span class="glyphicon glyphicon-log-in"></span>
                                    Login
                                </a>
                            </li>
                            @if(Request::path() == 'register')
                                <li class="active">
                            @else
                                <li>
                            @endif
                                <a href="{{ url('/register') }}">
                                    <span class="glyphicon glyphicon-user"></span>
                                    Register
                                </a>
                            </li>
                        @else
                            {{-- <li>
                                <form action="/search" method="POST" class="form-horizontal" style="margin-top: 7px">
                                    {{ csrf_field() }}
                                    <div class="form-inline">
                                        <input type="text" class="form-control" placeholder="Enter a keyword..." name="keyword">
                                        <button type="submit" class="btn btn-primary" name="search"><span class="glyphicon glyphicon-search"></span> Search</button>
                                    </div>
                                </form>
                            </li> --}}
                            @if(Request::path() == 'home' || Request::path() == 'AdminPage' || Request::path() == '/')
                                <li class="active">
                            @else
                                <li>
                            @endif
                                <a href="/home">
                                    <span class="glyphicon glyphicon-home"></span>
                                     Home
                                </a>
                            </li>
                            @if(Request::path() == 'search')
                                <li class="active">
                            @else
                                <li>
                            @endif
                                <a href="/search">
                                    <span class="glyphicon glyphicon-search"></span>
                                     Search
                                </a>
                            </li>
                            @if(Auth::user()->Role == 'User')
                                @if(Request::path() == 'collections')
                                    <li class="active">
                                @else
                                    <li>
                                        @endif
                                    <a href="/collections">
                                        <span class="glyphicon glyphicon-th-large"></span>
                                         Collections
                                    </a>
                                </li>
                                @if(Request::path() == 'list')
                                    <li class="active">
                                @else
                                    <li>
                                @endif
                                    <a href="/list">
                                        <span class="glyphicon glyphicon-list-alt"></span>
                                         List All
                                    </a>
                                </li>
                            @endif
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->FirstName }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    @if(Auth::user()->Role == 'User')
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
                            <a href="/users">Manage Users</a>
                        </li>
                        <li>
                            <a href="/search">Manage Files</a>
                        </li>
                        <li>
                            <a href="/logs">Logs</a>
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

        
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

        <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // $(document).ready(function(){
            var ConfirmNewPassword = "";

            $('#update').click(function(){
                 ConfirmNewPassword = $('#ConfirmNewPassword').val();

                // alert(ConfirmNewPassword);
                $.ajax({
                     type: "post",
                     url: "/changePassword",
                     data: {
                        '_token': $('input[name=_token]').val(),
                        'ConfirmNewPassword': $('#ConfirmNewPassword').val(),
                     },
                     success: function(data){
                         alert('Password Successfully changed!');
                     },
                     error: function(){
                        alert('Error');
                     }
                });
            });
        </script>
    </div>

    <!-- Scripts -->
    <script src="/js/app.js"></script>
</body>
</html>