<html lang="en" style="height: auto;"><head>


<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="3CRbFKoRPdg4YOCn1GsstWlLjnjjkFhk8NGCIslZ">

<title>Data Tim</title>

<link rel="stylesheet" href="{{url('/')}}/vendor/fontawesome-free/css/all.min.css">
<link rel="stylesheet" href="{{url('/')}}/vendor/overlayScrollbars/css/OverlayScrollbars.min.css">
<link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{url('/')}}/vendor/adminlte/dist/css/adminlte.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<link rel="stylesheet" type="text/css" href="{{url('/')}}/css/toastr/jquery.toast.css">
</head>

<body class="sidebar-mini" style="height: auto;">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav"></ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown user-menu">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        <span>
                            {{Auth::user()->name}}
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <li class="user-footer">
                            <a class="btn btn-default btn-flat float-right  btn-block " href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa fa-fw fa-power-off"></i>
                            Log Out
                        </a>
                        <form id="logout-form" action="/logout" 
                            method="POST" style="display: none;">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                        </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="{{url('/')}}/home" class="brand-link ">
                <img src="{{url('/')}}/vendor/adminlte/dist/img/AdminLTELogo.png" alt="AdminLTE" class="brand-image img-circle elevation-3" style="opacity:.8">
                <span class="brand-text font-weight-light ">
                    <b>POMM</b>TIJARI
                </span>

            </a>
            @include('marketplace.partials.sidebar')
        </aside>
        
        <div class="content-wrapper " style="min-height: 637.812px;">
            <div class="content-header">
                <div class="container-fluid">
                    <h1>@yield('title')</h1>
                </div>
            </div>
            <div class="content">
                @yield('content')
            </div>
        </div>
    </div>

<script src="{{url('/')}}/vendor/jquery/jquery.min.js"></script>
<script src="{{url('/')}}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{url('/')}}/vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="{{url('/')}}/vendor/adminlte/dist/js/adminlte.min.js"></script>
<script type="text/javascript" src="{{url('/')}}/js/toastr/jquery.toast.js"></script>
<script>
$(function() {
});
</script>

@yield('css')

@yield('js')




</body></html>