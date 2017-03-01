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
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/css/app.css">
    <link rel="stylesheet" type="text/css" href="/css/w3.css">
    <link rel="stylesheet" type="text/css" href="/css/fa/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="/css/responsive.dataTables.min.css">

    <!-- Scripts-->
    <script type="text/javascript" src="/js/app.js"></script>
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
                        {{-- <a href="/search" class="navbar-toggle">
                            <span class="glyphicon glyphicon-search"></span>                        
                        </a> --}}
                        <a href="/home" class="navbar-toggle">
                            <span class="glyphicon glyphicon-home"></span>                        
                        </a>
                        <a href="/changePassword" class="navbar-toggle">
                            <span class="fa fa-key" aria-hidden="true"></span>
                        </a>
                        <a href="/settings" class="navbar-toggle">
                            <span class="glyphicon glyphicon-cog"></span>
                        </a>
                        <a href="/list" class="navbar-toggle ">
                            <span class="glyphicon glyphicon-list-alt"></span>                        
                        </a>
                        @if(Auth::user()->Role == 'User')
                            <a href="/collections" class="navbar-toggle">
                                <span class="glyphicon glyphicon-th-large"></span>                
                            </a>
                        @endif
                        @if(Auth::user()->Role == 'Encoder' || Auth::user()->Role == 'Admin')
                            <a href="/AddFile" class="navbar-toggle">
                                <span class="glyphicon glyphicon-upload"></span>                        
                            </a>
                        @endif
                            
                    @endif
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <a class="navbar-brand" href="{{ url('/home') }}">
                        <span>
                            <img src="../../images/tup.png" height="30px" width="30px">
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
                            {{-- @if(Request::path() == 'search')
                                <li class="active">
                            @else
                                <li>
                            @endif
                                    <a href="/search">
                                        <span class="glyphicon glyphicon-search"></span>
                                         Search
                                    </a>
                                </li> --}}
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
                                        <li>
                                            <a href="/profile">My Profile</a>
                                        </li>
                                    @endif
                                    <li>
                                        <a href="/changePassword">Change Password</a>
                                    </li>
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
    </div>

    <!-- Scripts -->
    <script type="text/javascript" src="../js/kjua-0.1.1.min.js"></script>
    <script type="text/javascript" charset="utf8" src="/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/dataTables.responsive.min.js"></script>
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
            form.submit();
        }

        $(document).on('click', '.viewInfo', function(){
            var qrcode = $('.QRCode').html();
            var file_name = qrcode.replace(/\s/g, "") + "{{Auth::id()}}" + $(this).data('path')+ "&fidder=" + $(this).data('id');
            var el = kjua({
                text: file_name,
                size: 300,
                fill: '#000'
            });

            var el1 = kjua({
                text: file_name,
                size: 300,
                fill: '#000'
            });

            var el2 = kjua({
                text: file_name,
                size: 300,
                fill: '#000'
            });
            $('.modal-title').html($(this).data('title'));
            $('.authors').html($(this).data('authors'));
            $('.adviser').html($(this).data('adviser'));
            $('.category').html($(this).data('category'));
            $('.abstract').html($(this).data('abstract'));

            if(document.getElementById('file_link') != null){
                $('#file_link').attr('file_id',$(this).data('id'));
                document.getElementById('file_link').setAttribute('href',file_name);
                if(isEmpty($('.qrcodeCanvas'))){
                    document.querySelector('.qrcodeCanvas').appendChild(el);
                    // console.log('Its empty');
                }else{
                    $('.qrcodeCanvas').empty();
                    document.querySelector('.qrcodeCanvas').appendChild(el);
                }
            }

            if(document.getElementById('suggested_link') != null){
                $('#suggested_link').attr('file_id',$(this).data('id'));    
                document.getElementById('suggested_link').setAttribute('href',file_name);
                if(isEmpty($('.suggested_qrcodeCanvas'))){
                    document.querySelector('.suggested_qrcodeCanvas').appendChild(el1);
                    // console.log('Its empty');
                }else{
                    $('.suggested_qrcodeCanvas').empty();
                    document.querySelector('.suggested_qrcodeCanvas').appendChild(el1);
                }
            }
            else{
                console.log('suggested_link does not exist.')
            }

            if(document.getElementById('most_viewed_link') != null){
                $('#most_viewed_link').attr('file_id',$(this).data('id'));    
                document.getElementById('most_viewed_link').setAttribute('href',file_name);
                if(isEmpty($('.most_viewed_qrcodeCanvas'))){
                    document.querySelector('.most_viewed_qrcodeCanvas').appendChild(el2);
                    // console.log('Its empty');
                }else{
                    $('.most_viewed_qrcodeCanvas').empty();
                    document.querySelector('.most_viewed_qrcodeCanvas').appendChild(el2);
                }
            }
            // $('.abstract-title').html($(this).data('title'));
            
            // document.getElementById('file_link').setAttribute('href',"");
            // document.getElementById('file_link').setAttribute('onclick',"return false;post('/generate_temp', {name: '"+file_name+"'});");

            function isEmpty( el ){
              return !$.trim(el.html())
            }

            // $('#file_link').on('click', function(){
            //     post('/generate_temp', {name: file_name});
            // });
        });

        $(document).on('click','.updateFile',function(){
            $('#edit_title').val($(this).data('title'));
            $('#edit_abstract').val($(this).data('abstract'));
            $('#edit_category').html($(this).data('category'));
            $('#edit_authors').html($(this).data('authors'));
            $('#edit_course').val($(this).data('course'));
            $('#edit_adviser').val($(this).data('adviser'));
            $('#edit_date').val($(this).data('date'));
            $('#edit_id').val($(this).data('id'));
        });

        $(document).on('click','.openNotes',function(){
            var type = 'POST';
            var link_url = '/editNotes';
            var buttonValue = 'Update'

            // $('.notesButton').attr('id','notesButton'+$(this).data('file_id'));
            // $('.NotesForm').attr('id','NotesForm'+$(this).data('file_id'));
            $('#NotesMethod').remove();
            $('#NotesMethod_suggested').remove();
            $('#NotesMethod_most_viewed').remove();
            $('#NotesMethod_favorites').remove();
            $('#NotesMethod_bookmarks').remove();
            $('#FileNote_id').val($(this).data('file_id'));
            $('#FileNote_id_suggested').val($(this).data('file_id'));
            $('#FileNote_id_most_viewed').val($(this).data('file_id'));
            $('#FileNote_id_favorites').val($(this).data('file_id'));
            $('#FileNote_id_bookmarks').val($(this).data('file_id'));
            $('#NoteID').val($(this).data('note_id'));
            $('#NoteID_suggested').val($(this).data('note_id'));
            $('#NoteID_most_viewed').val($(this).data('note_id'));
            $('#NoteID_favorites').val($(this).data('note_id'));
            $('#NoteID_bookmarks').val($(this).data('note_id'));

            if($(this).data('notes') == ""){
                link_url = '/addNotes';
                buttonValue = 'Save';                    
                $('#edit_notes').val('');
                $('#edit_notes_suggested').val('');
                $('#edit_notes_most_viewed').val('');
                $('#edit_notes_favorites').val('');
                $('#edit_notes_bookmarks').val('');
            }else{
                $('#edit_notes').val($(this).data('notes'));
                $('#edit_notes_suggested').val($(this).data('notes'));
                $('#edit_notes_most_viewed').val($(this).data('notes'));
                $('#edit_notes_favorites').val($(this).data('notes'));
                $('#edit_notes_bookmarks').val($(this).data('notes'));
                $('#methodHandler').html('<input type="hidden" name="_method" id="NotesMethod" value="PATCH">');
                $('#methodHandler_suggested').html('<input type="hidden" name="_method" id="NotesMethod_suggested" value="PATCH">');
                $('#methodHandler_most_viewed').html('<input type="hidden" name="_method" id="NotesMethod_most_viewed" value="PATCH">');
                $('#methodHandler_favorites').html('<input type="hidden" name="_method" id="NotesMethod_favorites" value="PATCH">');
                $('#methodHandler_bookmarks').html('<input type="hidden" name="_method" id="NotesMethod_bookmarks" value="PATCH">');
            }
            $('#NotesForm').attr('method',type);
            $('#NotesForm').attr('action',link_url);
            $('#NotesForm_suggested').attr('method',type);
            $('#NotesForm_suggested').attr('action',link_url);
            $('#NotesForm_most_viewed').attr('method',type);
            $('#NotesForm_most_viewed').attr('action',link_url);
            $('#NotesForm_favorites').attr('method',type);
            $('#NotesForm_favorites').attr('action',link_url);
            $('#NotesForm_bookmarks').attr('method',type);
            $('#NotesForm_bookmarks').attr('action',link_url);
            $('#notesButton').text(buttonValue);
            $('#notesButton_suggested').text(buttonValue);
            $('#notesButton_most_viewed').text(buttonValue);
            $('#notesButton_favorites').text(buttonValue);
            $('#notesButton_bookmarks').text(buttonValue);
        });
    </script>
</body>
</html>