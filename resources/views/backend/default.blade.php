<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	  <link rel="icon" href="images/favicon.ico" type="image/ico" />
    @stack('meta')

    @stack('title')

    <link rel="shortcut icon" type="image/x-icon" href="{{ url('assets/images/logo.png') }}">
    <link href="cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link href="{{ url('assets/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('assets/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ url('assets/vendors/nprogress/nprogress.css') }}" rel="stylesheet">
    <link href="{{ url('assets/vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">
    <link href="{{ url('assets/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet">
    <link href="{{ url('assets/vendors/jqvmap/dist/jqvmap.min.css') }}" rel="stylesheet"/>
    <link href="{{ url('assets/vendors/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">

    <!-- Datatables -->
    
    <link href="{{ URL('assets/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL('assets/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL('assets/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL('assets/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL('assets/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ url('assets/build/css/custom.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.css" integrity="sha256-pODNVtK3uOhL8FUNWWvFQK0QoQoV3YA9wGGng6mbZ0E=" crossorigin="anonymous" />

    @stack('css')
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        @include('backend.partials.sidebar')
        @include('backend.partials.header')

        <div class="right_col" role="main">
            @yield('content')
        </div>

        @include('backend.partials.footer')
      </div>
    </div>

    <!-- jQuery -->
    <script src="{{ url('assets/vendors/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ url('assets/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('assets/vendors/fastclick/lib/fastclick.js') }}"></script>
    <script src="{{ url('assets/vendors/nprogress/nprogress.js') }}"></script>
    <script src="{{ url('assets/vendors/Chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ url('assets/vendors/gauge.js/dist/gauge.min.js') }}"></script>
    <script src="{{ url('assets/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
    <script src="{{ url('assets/vendors/iCheck/icheck.min.js') }}"></script>
    <script src="{{ url('assets/vendors/skycons/skycons.js') }}"></script>
    <script src="{{ url('assets/vendors/Flot/jquery.flot.js') }}"></script>
    <script src="{{ url('assets/vendors/Flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ url('assets/vendors/Flot/jquery.flot.time.js') }}"></script>
    <script src="{{ url('assets/vendors/Flot/jquery.flot.stack.js') }}"></script>
    <script src="{{ url('assets/vendors/Flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ url('assets/vendors/flot.orderbars/js/jquery.flot.orderBars.js') }}"></script>
    <script src="{{ url('assets/vendors/flot-spline/js/jquery.flot.spline.min.js') }}"></script>
    <script src="{{ url('assets/vendors/flot.curvedlines/curvedLines.js') }}"></script>
    <script src="{{ url('assets/vendors/DateJS/build/date.js') }}"></script>
    <script src="{{ url('assets/vendors/jqvmap/dist/jquery.vmap.js') }}"></script>
    <script src="{{ url('assets/vendors/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ url('assets/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js') }}"></script>
    <script src="{{ url('assets/vendors/moment/min/moment.min.js') }}"></script>
    <script src="{{ url('assets/vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

    <script src="{{ url('assets/vendors/jszip/dist/jszip.min.js') }}"></script>
    <script src="{{ url('assets/vendors/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ url('assets/vendors/pdfmake/build/vfs_fonts.js') }}"></script>

    <!-- Datatables -->
    <script src="{{ URL('assets/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL('assets/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ URL('assets/vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL('assets/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ URL('assets/vendors/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ URL('assets/vendors/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL('assets/vendors/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL('assets/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script>
    <script src="{{ URL('assets/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ URL('assets/vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL('assets/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js') }}"></script>
    <script src="{{ URL('assets/vendors/datatables.net-scroller/js/dataTables.scroller.min.js') }}"></script>

    <!-- Custom Theme Scripts -->
    <script src="{{ url('assets/build/js/custom.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.js" integrity="sha256-siqh9650JHbYFKyZeTEAhq+3jvkFCG8Iz+MHdr9eKrw=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.8/jquery.mask.js" integrity="sha512-2Pv9x5icS9MKNqqCPBs8FDtI6eXY0GrtBy8JdSwSR4GVlBWeH5/eqXBFbwGGqHka9OABoFDelpyDnZraQawusw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('script')
	
  </body>
</html>
