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
		display:flex;
	}
	.msg {

	}
	.menu-konsul {
		margin-top:100px;
		background-color: #888;
	}
	.menu-konsul .col-4.d-flex {
		padding: 50px;
	}
	.menu-konsul a {
		color: white;
	}
	.menu-konsul i {
		font-size : 36px;
	}
	.menu-konsul .col-4.d-flex:hover {
		background-color: #f96000;
	}
	thead .form-control{
	width:150px;
}
	/* width */
::-webkit-scrollbar {
    width: 10px;
}

/* Track */
::-webkit-scrollbar-track {
    background: #95a5a6; 
}
 
/* Handle */
::-webkit-scrollbar-thumb {
    background: #2980b9; 
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
    background: #555; 
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
					<a class="nav-link active" href="#mitra" data-toggle="collapse" data-parent="#contents">Mitra</a>
				</li>
				<!-- <li class="nav-item">
					<a class="nav-link" href="#konsultasi" data-toggle="collapse" data-parent="#contents">Konsultasi</a>
				</li> -->
				<li class="nav-item">
					<a class="nav-link" href="#laporan" data-toggle="collapse" data-parent="#contents">Laporan</a>
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
	<div id="contents" class="container-fluid content" data-children=".content-item">
		<div class="content-item">
			@include('module.mitra')
		</div>
		
		<!-- <div class="content-item">
			@include('module.konsultasi')
		</div> -->

		<div class="content-item">
			@include('module.laporan')
		</div>
	</div>
	<div class="backscreen justify-content-center align-items-center text-center">
		<div class="d-block">
			<i class="fa fa-cog fa-spin" style="font-size:48px;color: white"></i>
			<p class="text-white">Loading</p>
		</div>
	</div>
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
				loading(true);
			}, 500);
		});

		function loading(set){
			if(set){
				$('.backscreen').fadeIn(250);
			}
			else{
				$('.backscreen').fadeOut(250);
			}
		}
	</script>
@endpush