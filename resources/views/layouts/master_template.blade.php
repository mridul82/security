<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>@yield('title') </title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  {{-- <link href="{{asset('admin/assets/img/logo.jpg')}}" rel="icon"> --}}
  <link href="{{asset('admin/assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  {{-- toastr --}}
  <!-- Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">


  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('admin/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('admin/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('admin/assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('admin/assets/vendor/quill/quill.snow.css')}}" rel="stylesheet">
  <link href="{{asset('admin/assets/vendor/quill/quill.bubble.css')}}" rel="stylesheet">
  <link href="{{asset('admin/assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{asset('admin/assets/vendor/simple-datatables/style.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{asset('admin/assets/css/style.css')}}" rel="stylesheet">

  {{-- select2 css --}}
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css" rel="stylesheet">
 {{-- small button bootsrap class --}}
 <style>
  .btn-xs {
    padding: 0.25rem 0.5rem; /* Adjust padding */
    font-size: 0.75rem;      /* Smaller font size */
    line-height: 1.2;        /* Adjust line height */
  }
</style>
</head>

<body>

 @include('includes.header')

  <!-- ======= Sidebar ======= -->
  @include('includes.sidebar')

  <main id="main" class="main">


    @yield('header')

    <section class="section dashboard">
      <div class="row">
        @include('includes.flash_message')
                    @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif



            <!-- Sales Card -->



            @yield('content')



      </div>



    </section>
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>UC</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="#">Mridulesh Sarma</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  {{-- <script src="
  https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js
  "></script> --}}
  <script src="{{asset('admin/assets/vendor/jquery/dist/jquery.min.js')}}"></script>



  <!-- Vendor JS Files -->
  <script src="{{asset('admin/assets/vendor/apexcharts/apexcharts.min.js')}}"></script>
  <script src="{{asset('admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('admin/assets/vendor/chart.js/chart.umd.js')}}"></script>
  <script src="{{asset('admin/assets/vendor/echarts/echarts.min.js')}}"></script>
  <script src="{{asset('admin/assets/vendor/quill/quill.min.js')}}"></script>
  <script src="{{asset('admin/assets/vendor/simple-datatables/simple-datatables.js')}}"></script>
  <script src="{{asset('admin/assets/vendor/tinymce/tinymce.min.js')}}"></script>
  <script src="{{asset('admin/assets/vendor/php-email-form/validate.js')}}"></script>

<!-- Toastr JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

{{-- select2 js --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js"></script>
  <!-- Template Main JS File -->
  <script src="{{asset('admin/assets/js/main.js')}}"></script>
  @stack('script')
</body>

</html>
