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
    <link rel="stylesheet" href="/css/w3.css">
    <link rel="stylesheet" href="/css/fa/css/font-awesome.min.css">
    <!-- Scripts -->
    {{-- <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/jquery.min.js"></script> --}}
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script type="text/JavaScript" src="../js/kjua-0.1.1.min.js"></script>

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

    @yield('header')

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
                        <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="navbar-toggle">
                            <span class="glyphicon glyphicon-off"></span>
                        </a>
                        <a href="/search" class="navbar-toggle">
                            <span class="glyphicon glyphicon-search"></span>                        
                        </a>
                        <a href="/home" class="navbar-toggle">
                            <span class="glyphicon glyphicon-home"></span>                        
                        </a>
                        <a href="/settings" class="navbar-toggle">
                            <span class="glyphicon glyphicon-cog"></span>
                        </a>
                        <a href="/list" class="navbar-toggle ">
                            <span class="glyphicon glyphicon-list-alt"></span>                        
                        </a>
                        <a href="/collections" class="navbar-toggle">
                            <span class="glyphicon glyphicon-th-large"></span>                
                        </a>
                        @if(Auth::user()->Role == 'Encoder')
                            <a href="/AddFile" class="navbar-toggle">
                                <span class="glyphicon glyphicon-upload"></span>                        
                            </a>
                        @endif
                            
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
                                <form action="/search" method="POST" class="form-horizontal">
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
                            @if(Auth::user()->Role == 'Admin' || Auth::user()->Role == 'Encoder')
                                @if(Request::path() == 'AddFile')
                                    <li class="active">
                                @else
                                    <li>
                                @endif
                                        <a href="/AddFile">
                                            <span class="glyphicon glyphicon-upload"></span>
                                            Upload                        
                                        </a>
                                    </li>
                            @endif
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
                            @if(Auth::user()->Role == 'User' || Auth::user()->Role == 'Encoder')
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
                                    @if(Auth::user()->Role == 'User' || Auth::user()->Role == 'Encoder')
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
            </nav>
            @if(!Auth::guest())
                @if(Auth::user()->Role == 'Admin')
                <div class="dropdown" style="float: left;">
                <button class="dropbtn"><span class="glyphicon glyphicon-menu-hamburger"></span></button>
                <div class="dropdown-content side-nav">
                    <a href="/">Dashboard</a>    
                    <a href="/users">Manage Users</a>            
                    <a href="/InactiveUsers">Inactive Users</a>            
                    <a href="/list">Manage Files</a> 
                    <a href="/ArchivedFiles">Archived Files</a>      
                    <a href="/logs">Logs</a>
                    {{-- <a href="#">Reports</a>--}}
                    <a href="/settings">Admin Settings</a>
                </div>
                </div>
                @endif
            @endif        
        @yield('content')
        @yield('footer')        
        @yield('script-section')

        <script type="text/javascript">
            $.ajaxSetup
            ({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            function post(path, params, method) {
                method = method || "post"; // Set method to post by default if not specified.

                // The rest of this code assumes you are not using a library.
                // It can be made less wordy if you use one.
                var form = document.createElement("form");
                form.setAttribute("method", method);
                form.setAttribute("action", path);

                for(var key in params) {
                    if(params.hasOwnProperty(key)) {
                        var hiddenField = document.createElement("input");
                        hiddenField.setAttribute("type", "hidden");
                        hiddenField.setAttribute("name", key);
                        hiddenField.setAttribute("value", params[key]);

                        var hiddenToken = document.createElement("input");
                        hiddenToken.setAttribute("type", "hidden");
                        hiddenToken.setAttribute("name", "_token");
                        hiddenToken.setAttribute("value", "{{ csrf_token() }}");

                        form.appendChild(hiddenToken);

                        form.appendChild(hiddenField);
                     }
                }

                document.body.appendChild(form);
                // alert(form.innerHTML);
                form.submit();
            }

            $(document).on('click', '.viewInfo', function(){
                
                // var encrypted_data = $('.QRCode').text().replace(/\s/g, "");
                // var decrypted_data = "";

                // $.ajax({
                //     type: 'GET',
                //     url: '/encrypted_data?' + encrypted_data,
                //     data: encrypted_data,
                //     dataType: 'json',
                //     success: function(data){
                //         console.log(data);
                //     },
                //     error: function(data){
                //         console.log("Error" + data);
                //     }
                // });

                // $.get("/encrypted_data?" + encrypted_data, { "data": encrypted_data } )
                //     .done(function(data) {
                //         // decrypted_data = data;
                //         console.log(data);
                // });
                {{-- var qrcode = "{{decrypt(".encrypted_data.")}}" + $(this).data('path'); --}}
                var qrcode = $('.QRCode').html() + $(this).data('path');
                var file_name = qrcode.replace(/\s/g, "");
                var el = kjua({
                    text: qrcode.replace(/\s/g, ""),
                    size: 300,
                    fill: '#000'
                });

                $('.modal-title').html($(this).data('title'));
                $('#file_link').attr('file_id',$(this).data('id'));
                $('.abstract').html($(this).data('abstract'));
                // $('.abstract-title').html($(this).data('title'));
                document.getElementById('file_link').setAttribute('href',file_name);
                
                // document.getElementById('file_link').setAttribute('href',"");
                // document.getElementById('file_link').setAttribute('onclick',"return false;post('/generate_temp', {name: '"+file_name+"'});");

                if(isEmpty($('.qrcodeCanvas'))){
                    document.querySelector('.qrcodeCanvas').appendChild(el);
                    // console.log('Its empty');
                }else{
                    $('.qrcodeCanvas').empty();
                    document.querySelector('.qrcodeCanvas').appendChild(el);
                }

                function isEmpty( el ){
                  return !$.trim(el.html())
                }

                // $('#favorite').click(function(){
                //     $.ajax({
                //         type: 'POST',
                //         url: '/favorite',
                //         data: $('.file_id').text(),
                //         success: function(data){
                //             console.log('Congrats' + data);         
                //         },
                //         error: function(){
                //             console.log('Error');
                //         }
                //     });
                // });

                // $('#file_link').on('click', function(){
                //     post('/generate_temp', {name: file_name});
                // });
            });
        </script>
    </div>

    <!-- Scripts -->
    <script src="/js/app.js"></script>
</body>
</html>