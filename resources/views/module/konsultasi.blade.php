<div id="konsultasi" class="konsultasi collapse module p-5" ng-controller="konsultasi">
	<div class="header">
		<h3 class="display-3 text-center">Konsultasi Mitra PLUT</h3>
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
		<div class="row mx-5 menu-konsul">
			<div class="col-4 d-flex justify-content-center">
				<a href="#" class="d-flex justify-content-center flex-column text-center">
					<i class="fa fa-check-square-o" aria-hidden="true"></i>
					<div>Konsultasi Hari Ini</div>
				</a>
			</div>
			<div class="col-4 d-flex justify-content-center">
				<a href="#" class="d-flex justify-content-center flex-column text-center">
					<i class="fa fa-file-text-o" aria-hidden="true"></i>
					<div>Rekap Konsultasi</div>
				</a>
			</div>
			<div class="col-4 d-flex justify-content-center">
				<a href="#" data-target="#form-pendataan-masalah" data-toggle="modal" class="d-flex justify-content-center flex-column text-center">
					<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
					<div>Pendataan Konsultasi</div>
				</a>
			</div>
		</div>
		<div id="konsultasi-content" class="row">
				
		</div>
		@include('dialog.pendataan-masalah')
	</div>
</div>

@push('script')
<script type="text/javascript">
	//konsultasi
	plutAPP.controller('konsultasi',function($scope,$http){
		$scope.data = null;
		$scope.btn__save = function(e,url){
			var dataMitra = angular.element(e).find('form').serialize();
			$http.post(url,dataMitra,{ 
				headers : {
        			'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
    			}
			})
			.then(function(e){
				console.log(e.data);
				//$scope.update__list();
			})
			.catch(function(response){
				console.log(response);
				angular.element('#error-dialog').find('.modal-body').html(response.data.message);
				angular.element('#error-dialog').modal('show');
				angular.element(e).modal('hide');
			});
			;
		}
		$scope.update__list = function(){
			$http.get('{{route("konsultasi-list")}}').then(function(e){
					console.log(e);
					$scope.data = e.data;
				});
			};
	});
</script>
@endpush