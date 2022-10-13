<!doctype html>
<html lang="en">

<head>
    @guest
    <title>Folarium | Login</title>
    @else
    <title>Folarium</title>
    @endguest
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <meta name="csrf-token" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="description" content="Mooli Bootstrap 4x admin is super flexible, powerful, clean &amp; modern responsive admin dashboard with unlimited possibilities.">
    <meta name="author" content="GetBootstrap, design by: puffintheme.com">

    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="{{asset('assets')}}/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets')}}/vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('assets')}}/vendor/animate-css/vivify.min.css">

    <link rel="stylesheet" href="{{asset('assets')}}/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{asset('assets')}}/css/mooli.min.css">
    <style>
        .hidden {
            display: none;
        }

        button.dt-button,
        div.dt-button,
        a.dt-button {
            border-radius: 11px;
            border-color: #e3081d;
            border: #e3081d;
            color: #e3081d;
        }

        table.dataTable {
            margin-bottom: 20px !important;
        }

        .StandardTable {
            border-radius: 10px;
            -moz-border-radius: 10px;
            margin-left: auto;
            margin-right: auto;
            margin-bottom: 10px;
            box-shadow: 10px 5px 5px #8a9779;
            margin-bottom: 15px;
            border-spacing: 0;
        }

        .StandardTable thead {
            border-radius: 10px;
            -moz-border-radius: 10px;
            border-radius: 5px;
            background-color: #ececec;
            color: #000;
        }
    </style>
</head>

<body>

    <div id="body" class="theme-green">
        @auth
        <div id="wrapper">
            @include('layouts.sidebar')
            <div id="main-content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>
        @else
        @yield('content')
        @endauth
    </div>

    <script src="{{asset('assets')}}/bundles/libscripts.bundle.js"></script>
    <script src="{{asset('assets')}}/bundles/vendorscripts.bundle.js"></script>

    <script src="{{asset('assets')}}/bundles/mainscripts.bundle.js"></script>
    <script src="{{asset('assets')}}/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    @stack('js')
</body>

</html>