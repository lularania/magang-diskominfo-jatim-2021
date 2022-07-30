<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title>Hoster | @yield('title')</title>
    <link rel="icon" href="{{ asset('assets/img/jatim.png') }}" type="image/png">
    <!-- Extra details for Live View on GitHub Pages -->
    <!-- Canonical SEO -->
    <link rel="canonical" href="https://www.creative-tim.com/product/argon-dashboard-pro" />
    <!--  Social tags      -->
    <meta name="keywords" content="dashboard, bootstrap 4 dashboard, bootstrap 4 design, bootstrap 4 system, bootstrap 4, bootstrap 4 uit kit, bootstrap 4 kit, argon, argon ui kit, creative tim, html kit, html css template, web template, bootstrap, bootstrap 4, css3 template, frontend, responsive bootstrap template, bootstrap ui kit, responsive ui kit, argon dashboard">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="Argon - Premium Dashboard for Bootstrap 4 by Creative Tim">
    <meta itemprop="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta itemprop="image" content="https://s3.amazonaws.com/creativetim_bucket/products/137/original/opt_adp_thumbnail.jpg">
    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@creativetim">
    <meta name="twitter:title" content="Argon - Premium Dashboard for Bootstrap 4 by Creative Tim">
    <meta name="twitter:description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="twitter:creator" content="@creativetim">
    <meta name="twitter:image" content="https://s3.amazonaws.com/creativetim_bucket/products/137/original/opt_adp_thumbnail.jpg">
    <!-- Open Graph data -->
    <meta property="fb:app_id" content="655968634437471">
    <meta property="og:title" content="Argon - Premium Dashboard for Bootstrap 4 by Creative Tim" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="https://demos.creative-tim.com/argon-dashboard/index.html" />
    <meta property="og:image" content="https://s3.amazonaws.com/creativetim_bucket/products/137/original/opt_adp_thumbnail.jpg" />
    <meta property="og:description" content="Start your development with a Dashboard for Bootstrap 4." />
    <meta property="og:site_name" content="Creative Tim" />

    <!-- jQuery -->
    <script src="{{ asset('assets/adminlte') }}/plugins/jquery/jquery.min.js"></script>

    <!-- PDF Object -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.2.6/pdfobject.min.js" integrity="sha512-B+t1szGNm59mEke9jCc5nSYZTsNXIadszIDSLj79fEV87QtNGFNrD6L+kjMSmYGBLzapoiR9Okz3JJNNyS2TSg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Highcharts JS  -->
    <script src="https://code.highcharts.com/highcharts.js"></script>

    @include('layouts.links')
</head>

<body class="hold-transition sidebar-mini">
    {{-- <!-- Site wrapper --> --}}
    <div class="wrapper">
        {{-- <!-- Sweet Alert --> --}}
        @include('sweetalert::alert')

        {{-- <!-- Navbar --> --}}
        @include('layouts.navbar')
        {{-- <!-- /.navbar --> --}}

        {{-- <!-- Main Sidebar Container --> --}}
        @include('layouts.sidebar')

        {{-- <!-- Content Wrapper. Contains page content --> --}}
        <div class="content-wrapper">
            {{-- <!-- Content Header (Page header) --> --}}
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        @yield('header')
                    </div>
                </div>
                {{-- <!-- /.container-fluid --> --}}
            </section>

            {{-- <!-- Main content --> --}}
            <section class="content">

                {{-- <!-- Default box --> --}}
                @yield('content')
                {{-- <!-- /.card --> --}}
                @yield('scripts')

            </section>
            {{-- <!-- /.content --> --}}
        </div>
        {{-- <!-- /.content-wrapper --> --}}

        @include('layouts.footer')

        {{-- <!-- Control Sidebar --> --}}
        <aside class="control-sidebar control-sidebar-dark">
            {{-- <!-- Control sidebar content goes here --> --}}
        </aside>
        {{-- <!-- /.control-sidebar --> --}}
    </div>
    {{-- <!-- ./wrapper --> --}}

    @include('layouts.scripts')
</body>

</html>
