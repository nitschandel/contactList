<html>
    <!-- START Head -->
    <head>
        <!-- START META SECTION -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="author" content="Admin Dashboard">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
        <title>Contact List | Web Dashboard</title>

        
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

        <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('css/layout.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('css/jquery-ui.min.css') }}" />

        <script type="text/javascript" src="{{ URL::asset('js/jquery-3.2.0.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>

        <script type="text/javascript" src="{{ URL::asset('js/jquery-ui.min.js') }}"></script>

    </head>
    <body>
        <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/contacts">
                    <img src="{{ URL::asset('images/logo.png') }}" alt="/" style="height : 50px;">
                </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="/contacts">Contact List Management System</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="/contacts">Contacts</a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{$name}} <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="/logout">Logout</a></li>
                        </ul>
                      </li>

                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    @yield('content')
    </body>
    <!--/ END Body -->
</html>