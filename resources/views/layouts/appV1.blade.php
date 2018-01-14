<!DOCTYPE html>
<html ng-app="plut">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PLUT KUMKM @yield('title')</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}" type="text/css">
  <style type="text/css">
    
    @stack('css')
  </style>
</head>

<body>
  <div class="app-plut">
    @yield('content')
  </div>
  <script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.6/angular.min.js"></script>
  <script src="{{asset('js/popper.min.js')}}"></script>
  <script src="{{asset('js/bootstrap.min.js')}}"></script>
  <script type="text/javascript">
    var plutAPP = angular.module('plut', [], function($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });
  </script>
  @yield('after-scripts')
  @stack('script')
</body>

</html>