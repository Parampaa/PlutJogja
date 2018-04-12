<!DOCTYPE html>
<html ng-app="plut">

<head>
  @include('layouts.favicon')
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PLUT KUMKM @yield('title')</title>
  <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}" type="text/css">
  <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}" type="text/css">
  <link rel="stylesheet" href="{{asset('css/toastr.min.css')}}" type="text/css">
  <style type="text/css">
    @stack('css')
  </style>
</head>

<body>
  <div class="app-plut">
    @yield('content')
  </div>
  <script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/Chart.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/angular.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/angular-cookies.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/angular-chart.min.js')}}"></script>
  
  <script src="{{asset('js/popper.min.js')}}"></script>
  <script src="{{asset('js/bootstrap.min.js')}}"></script>
  <script src="{{asset('js/toastr.min.js')}}"></script>
  <script type="text/javascript">
    var plutAPP = angular.module('plut', ['ngCookies','chart.js'], function($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });
    plutAPP.filter('default', function(){
      return function(value, def) {
        return (value === undefined || value === null? def : value);
      };
    });
    
  </script>
  @yield('after-scripts')
  @stack('script')
</body>

</html>