<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modernize Free</title>
    <link rel="shortcut icon" type="image/png" href="assets/dahboard/images/logos/favicon.png" />
    <link rel="stylesheet" href="assets/dashboard/css/styles.min.css" />
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        @include('dashboard.partials.sidebar')
        <!--  Sidebar End -->

        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            @include('dashboard.partials.header')
            <!--  Header End -->
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    </div>
    <script src="assets/dashboard/libs/jquery/dist/jquery.min.js"></script>
    <script src="assets/dashboard/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/dahboard/js/sidebarmenu.js"></script>
    <script src="assets/dahboard/js/app.min.js"></script>
    <script src="assets/dahboard/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="assets/dahboard/libs/simplebar/dist/simplebar.js"></script>
    <script src="assets/dahboard/js/dashboard.js"></script>
</body>

</html>
