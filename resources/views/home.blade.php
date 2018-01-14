@extends('layouts.appV1')

@push('css')
	.menu{
		z-index:99;
	}
	.navmenu{
		padding:50px;
	}
	.navmenu{
		background: #2c3e50;
	}
	.navmenu-button {
		background: #34495e;
	}
	.navmenu .nav-item a.nav-link {
		color:white;
	}
	.navmenu .nav-item a.nav-link:hover {
		background-color: #f39c12;
	}

	.nav-link.active {
		background-color: #e67e22;
	}
	.module {

	}
	.backscreen {
		background: rgba(0,0,0,0.5);
		position: fixed;
		left:0;
		top:0;
		width:100%;
		height:100%;
		z-index: 1;
		display:block;
	}
	.msg {

	}
@endpush

@section('content')
	<div class="position-fixed text-white h-100 d-flex flex-row menu">
		<div class="navmenu">
			<ul class="nav flex-column d-block">
				<li class="nav-item">
					<p class="display-4">PLUT JOGJA</p>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="#">Mitra</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Konsultan</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
				</li>

			</ul>
		</div>
		<div>
			<a class="navmenu-button d-flex justify-content-center p-3" href="#">
				<i class="fa fa-bars fa-5" aria-hidden="true"></i>
			</a>
		</div>
	</div>
	<div class="container-fluid content">
		<div class="mitra module p-5" ng-controller="mitra">
			<div class="header">
				<h3 class="display-3 text-center">Pengelolaan Mitra PLUT</h3>
			</div>
			<div class="body">
				@if (Session::has('msg'))
				<div class="msg">
					<div class="alert alert-success alert-dismissible fade show" role="alert">
					  <strong>Sukses!</strong> {{Session::get('msg')}}
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
					</div>
				</div>
				@endif
				<button class="btn btn-success" data-target="#form-pendaftaran" data-toggle="modal">Tambah</button>
				@include('table.list-mitra')
				@include('dialog.pendaftaran-mitra')
				@include('dialog.edit-mitra')
			</div>
		</div>
		@push('script')
			<script type="text/javascript">
				plutAPP.controller('mitra',function($scope,$http){
					$scope.lokasi = JSON.parse('{!!$lokasi!!}');
					console.log($scope.lokasi);
					$scope.data = null;

					$scope.mitra__btn__save = function(e){
						angular.element('.modal.show').find('form').submit();
						//angular.element(e).find('form').submit();
						// var dataMitra = angular.element('#form-pendaftaran').find('form').serialize();
						// $http.post('{{route("mitra-add")}}',dataMitra,
						// 	{ 
						// 		headers : {
      //               			'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
      //           			}
      //       			})
						// .then(function(e){
						// 	$http.get('{{route("mitra-list")}}').then(function(e){
						// 		console.log('--');
						// 		console.log(e);
						// 		console.log(dataMitra);
						// 		$scope.mitra__update__list();
						// 	});
						// });
					}
					$scope.mitra__update__list = function(){
						$http.get('{{route("mitra-list")}}').then(function(e){
							console.log(e);
							$scope.data = e.data;
						});
					};
					$scope.mitra__delete = function(id){
						console.log(id);
						$http.post('{{url("kelola/mitra/delete")}}/'+id,{'_token':'{{csrf_token()}}'})
						.then(function(e){
							$scope.mitra__update__list();
						});
					};
					$scope.mitraEdit = null;
					$scope.kabselected = 0;
					$scope.mitra__edit = function(id){
						$http.get('{{route("mitra-show")}}/?id='+id)
						.then(function(e){
							console.log(e.data);
							$scope.mitraEdit = e.data;
							$scope.kabselected = $scope.mitraEdit.kabupaten;
							
							$http.get('{{route("mitra-produk")}}/?id='+id)
							.then(function(e){
								console.log(e.data);
								$scope.mitraProduk = e.data;
							});
						});

					}
					$scope.mitra__update__list();

				});
			</script>
		@endpush
		<div class="konsultasi module p-5"></div>
	</div>
	<div class="backscreen"></div>
	@include('dialog.error')
@endsection
@push('script')
	<script type="text/javascript">
		var menu = true;
		function toggle__menu(){
			var speed = 250;
			if(!menu){
				$('.menu').animate({
					'left':-($('.navmenu').width()+100)+'px'
				},speed);
				$('.content').animate({
					'margin-left':0
				},speed);
				$('.backscreen').fadeOut(speed);
				
			}
			else{
				$('.menu').animate({
					'left':'0px'
				},speed);
				
				$('.content').animate({
					'margin-left':($('.navmenu').width()+100)+'px'
				},speed);
				$('.backscreen').fadeIn(speed);
			}
			menu = !menu;
		}
		$(document).ready(function(){
			toggle__menu();
			$('.navmenu-button').click(function(e){
				toggle__menu();
			});
			$('.navmenu .nav-link').click(function(){
				$('.navmenu .nav-link.active').removeClass('active');
				$(this).addClass('active');
				toggle__menu();
			});
			setTimeout(function() {
				toggle__menu();
			}, 500);
		});
	</script>
@endpush













@section('hehe')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
