@extends('layouts.appV1')

@section('title','Login Area')

@section('custom-css')
    .has-error{
        color:#F00;
    }
    .has-error input,.has-error input:focus{
        border:#F00 solid 1px;
    }

@endsection

@section('content')
<div id="login-page" class="py-5 h-100 w-100 d-flex gradient-overlay" style="background-image: url(&quot;http://www.plutjogja.com/wp-content/uploads/2017/10/WhatsApp-Image-2017-10-11-at-13.46.09.jpeg&quot;); background-size: cover;">
    <div class="container align-self-center">
      <div class="row">
        <div class="align-self-center col-md-6 text-white">
          <h1 class="text-center text-md-left display-3 text-warning">PLUT JOGJA</h1>
          <p class="lead text-warning">Semangat gaes, Semoga diberkahi Allah</p>
        </div>
        <div class="col-md-6" id="book">
          <div class="card">
            <div class="card-body p-5 border border-dark border-5">
              <h3 class="pb-3 display-4">Login Akun</h3>
              <form action="{{ route('login') }}" method="POST" class="">

                {{ csrf_field() }}
                
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}"> 
                    <label>Email</label>
                        <input class="form-control" placeholder="Alamat Email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                    
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                    </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label>Password</label>
                        <input type="password" class="form-control" placeholder="Password" name="password" value="{{ old('password') }}" required> 
                    @if ( $errors->has('password') )
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                    </div>

                <div class="form-group">
                    <div class="checkbox">
                        <label><input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Ingat Saya di komputer ini</label>    
                        </div>
                    </div>
                
                <button type="submit" class="btn mt-2 btn-outline-success">Login</button>
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    Lupa Password?
                </a>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('after-scripts')
    <script type="text/javascript">

        $(document).ready(function(){
            /**
            Script untuk mengubah status posisi container dari login
            Supaya background tidak pecah mengikuti ukuran window
            if < 1200 px atau large device sesuai bootstrap maka
                -> position: absolute
            else 
                -> position: fixed
            */
            
            //  check di awal load
            if($('body').width() >= 1200)
                $('#login-page').addClass('position-fixed');

            //  check setiap kali ada perubahan ukuran window
            $(window).on('resize',function(){
                var statepage=$('#login-page').hasClass('position-fixed');
                if($('body').width() >= 1200){
                    if(!statepage)
                        $('#login-page').addClass('position-fixed');
                }
                else if(statepage){
                    $('#login-page').removeClass('position-fixed');
                }
            });

            /**
            * menghilangkan pesan error jika user melakukan interaksi dengan keyboard
            */
            $('input').on('keyup',function(){
                var element = $(this).parents('.form-group');
                if(element.hasClass('has-error')){
                    element.find('span').remove();
                    element.removeClass('has-error');
                }
            });
        });
    </script>
@endsection









@section('hehe')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


