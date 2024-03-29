<!DOCTYPE html>
<html lang="en">
    <head>
        <title>@yield('title')</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" type="image/png" href="general/images/favicon-bbi.png"/>
        <link rel="stylesheet" type="text/css" href="account/vendor/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="account/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="account/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
        <link rel="stylesheet" type="text/css" href="account/vendor/animate/animate.css">
        <link rel="stylesheet" type="text/css" href="account/vendor/css-hamburgers/hamburgers.min.css">
        <link rel="stylesheet" type="text/css" href="account/vendor/animsition/css/animsition.min.css">
        <link rel="stylesheet" type="text/css" href="account/vendor/select2/select2.min.css">
        <link rel="stylesheet" type="text/css" href="account/vendor/daterangepicker/daterangepicker.css">

        <link rel="stylesheet" type="text/css" href="account/css/util.css">
        <link rel="stylesheet" type="text/css" href="account/css/main.css">

    </head>

    <body style="background-color: #666666;">

    @yield('container')

    <script src="account/vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="account/vendor/animsition/js/animsition.min.js"></script>
    <script src="account/vendor/bootstrap/js/popper.js"></script>
    <script src="account/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="account/vendor/select2/select2.min.js"></script>
    <script src="account/vendor/daterangepicker/moment.min.js"></script>
    <script src="account/vendor/daterangepicker/daterangepicker.js"></script>
    <script src="account/vendor/countdowntime/countdowntime.js"></script>
    <script src="account/js/main.js"></script>

    </body>
</html>