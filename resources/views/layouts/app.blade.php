<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="/assets/dashboard/images/logos/logotitle.png" />
    <title>@yield('title')</title>
    <link rel="stylesheet" href="/assets/dashboard/css/styles.min.css" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    {{-- Data Tables --}}
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />

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
    @include('sweetalert::alert')

    <script src="/assets/dashboard/libs/jquery/dist/jquery.min.js"></script>
    <script src="/assets/dashboard/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/dashboard/js/sidebarmenu.js"></script>
    <script src="/assets/dashboard/js/app.min.js"></script>
    <script src="/assets/dashboard/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="/assets/dashboard/libs/simplebar/dist/simplebar.js"></script>
    {{-- <script src="/assets/dashboard/js/dashboard.js"></script> --}}

    <script src="/assets/dashboard/js/datatables-simple-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>

    @stack('style')
    @yield('scripts')
    @stack('script')

</body>

</html>
