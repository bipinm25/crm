<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Robust admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template.">
    <meta name="keywords" content="admin template, robust admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
    <meta name="author" content="PIXINVENT">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CRM</title>
    <link rel="apple-touch-icon" href="{{asset("app-assets/images/ico/apple-icon-120.png")}}">
    <link rel="shortcut icon" type="image/x-icon" href="https://pixinvent.com/bootstrap-admin-template/robust/app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CMuli:300,400,500,700" rel="stylesheet">
	  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">  
 
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset("app-assets/css/vendors.min.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("app-assets/vendors/css/tables/datatable/datatables.min.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("app-assets/vendors/css/extensions/unslider.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("app-assets/vendors/css/weather-icons/climacons.min.css")}}">
    <!-- END VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset("app-assets/vendors/css/forms/icheck/icheck.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("app-assets/vendors/css/forms/icheck/custom.css")}}">
    <!-- BEGIN ROBUST CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset("app-assets/css/app.min.css")}}">
    <!-- END ROBUST CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset("app-assets/css/core/menu/menu-types/vertical-menu.min.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("app-assets/css/core/colors/palette-gradient.min.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("app-assets/css/plugins/calendars/clndr.min.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("app-assets/css/core/colors/palette-climacon.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("app-assets/css/pages/users.min.css")}}">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset("assets/css/style.css")}}">
    <!-- END Custom CSS-->
  </head>

  <body class="vertical-layout vertical-menu 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu" data-col="2-columns">

 @include('layout.header')

 
 @include('layout.sidebar')

 <div class="app-content content">
   <div class="content-wrapper">
      @yield('actions')
      <div class="content-body">
        @yield('content')
      </div>
   </div>
</div>

@include('layout.footer')
    <!-- BEGIN VENDOR JS-->
    <script src="{{ asset("app-assets/vendors/js/vendors.min.js")}}"></script>
    <!-- BEGIN VENDOR JS-->
    <script src="{{ asset("app-assets/vendors/js/tables/datatable/datatables.min.js")}}"></script>
    
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="{{ asset("app-assets/vendors/js/extensions/jquery.knob.min.js")}}"></script>    
    <script src="{{ asset("app-assets/vendors/js/extensions/moment.min.js")}}"></script>
    <script src="{{ asset("app-assets/vendors/js/extensions/underscore-min.js")}}"></script>
    <script src="{{ asset("app-assets/vendors/js/extensions/clndr.min.js")}}"></script>
    <script src="{{ asset("app-assets/vendors/js/extensions/unslider-min.js")}}"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN ROBUST JS-->
    <script src="{{ asset("app-assets/js/core/app-menu.min.js")}}"></script>
    <script src="{{ asset("app-assets/js/core/app.min.js")}}"></script>
    <script src="{{ asset("app-assets/js/scripts/customizer.min.js")}}"></script>
    <script src="{{ asset("app-assets/vendors/js/forms/icheck/icheck.min.js")}}"></script>
    <!-- END ROBUST JS-->    
    <script>
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
    </script>
    @yield('javascript')
  </body>
</html>