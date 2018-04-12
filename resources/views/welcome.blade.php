<!DOCTYPE html>

<html>

<head>

        @include('layouts.favicon')

      <!--   <script type="text/javascript" src="jquery.min.js"></script>
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
         -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}" type="text/css">
        <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}" type="text/css"> 
        <style>
            .tombol{
              height: 50px;
              font-size: 20px;
              width: 125px;
            }
            .tombol:hover{
              color: black;
            }
            #backstyle {
              background:url('{{asset('img/plut.jpg')}}');
              
              background-size: cover;
              background-color: black;
            }
        </style>
</head>
  

<body>
  <nav class="navbar fixed-top navbar-expand-md bg-dark navbar-dark">
    <div class="container ml-3">
      <ul class="navbar-nav">
        <li class="nav-item">
            <img class="img-fluid" src="{{asset('img/logocispu.png')}}" width="35" height="35"> 
          </li>
         <li class="nav-item" >
            <a class="btn navbar-btn pl-1 text-white">CIS PLUT DIY</a>
          </li>
      </ul>
        

          
      </div>
    </div>
  </nav>
  <!-- background style="background: rgba(200, 200, 200, 0.25);" -->
  <div 
    id="backstyle" 
    class="w-100 h-100 position-absolute"> 
        <div class="container ml-2 d-flex align-" style="padding-top: 10%;">
            <div 
              style="background: rgba(75, 75, 75, 0);" 
              class="jumbotron d-inline-flex p-2">
                 <div > 
                   <h1 style="color: white">Sistem Rekap Data UMKM</h1><br>
                   
        
                 <center><a class="btn tombol btn-outline-light btn-lg a" href="{{route('login')}}">Login</a></center>
                    
                   </div>
                 
             </div>

        </div>
        
  </div>

  <script src="{{asset('js/jquery.min.js')}}"></script>
  <script src="{{asset('js/popper.min.js')}}"></script>
  <script src="{{asset('js/bootstrap.min.js')}}"></script>
  
</body>

</html>