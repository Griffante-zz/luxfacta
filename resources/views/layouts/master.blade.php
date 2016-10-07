<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Luxfacta - @yield('title')</title>

        <!-- Bootstrap Core CSS -->
        <!--<link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">-->

        <!-- Custom CSS -->
        <link href="{{asset('css/luxfacta.min.css')}}" rel="stylesheet">
        <link href="{{asset('css/sb-admin.css')}}" rel="stylesheet">

        <!-- Morris Charts CSS -->
        <link href="{{asset('css/plugins/morris.css')}}" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="{{asset('font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        
        <!-- jQuery -->
        <script type='text/javascript' src="{{asset('js/jquery.js')}}"></script>
        
        <!-- jQuery Mask -->
        <script type='text/javascript' src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script type='text/javascript' src="{{asset('js/bootstrap.min.js')}}"></script>
        
        <!-- Morris Charts JavaScript -->
        <script type='text/javascript' src="{{asset('js/plugins/morris/raphael.min.js')}}"></script>
        <script type='text/javascript' src="{{asset('js/plugins/morris/morris.min.js')}}"></script>
        <script type='text/javascript' src="{{asset('js/plugins/morris/morris-data.js')}}"></script>

        <!-- Knockout -->
        <script type='text/javascript' src="{{asset('vendor/knockout/knockout-3.4.0.js')}}"></script>
        
        <!-- Knockout Validation -->
        <script type='text/javascript' src="https://cdnjs.cloudflare.com/ajax/libs/knockout-validation/2.0.3/knockout.validation.min.js"></script>

    </head>

    <body>

        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!--<a class="navbar-brand" href="{{ url('') }}">Luxfacta</a>-->
                    <a class="navbar-brand" href="{{ url('') }}"><img src="{{asset('img/logo.png')}}" width="120" height="40" data-pin-nopin="true" title="Luxfacta"></a>
                </div>
                <!-- Top Menu Items -->
                @include('layouts.topmenu')
                <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
                @include('layouts.sidebar')
                <!-- /.navbar-collapse -->
            </nav>

            <div>

                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

        <script>
            var item = "@yield('title')";
            var name = item.toLowerCase();
            $("#sidebar-"+name).addClass('active');
        </script>
        
    </body>

</html>