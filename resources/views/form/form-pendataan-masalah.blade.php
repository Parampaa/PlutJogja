@push('css')
	.optional {
		display:none;
	}
	.required-form:after{
		content: " *";
		color: red;
	}
	.hasilQuery{
		display:none;
		background-color:white;
		width:100%;
		border: 1px solid cyan;
		top:70px;
		padding:0;
	}
	.hasilQuery li {
		list-style:none;
		padding:0;
	}
	.hasilQuery div{
		padding: 15px 10px;
		
	}
	.hasilQuery div:hover{
		background-color: #f96000;
}
@endpush
<form class="col-12" method="POST" action="{{route('konsultasi-add')}}" ng-controller="form-pendataan-masalah">
	{{ csrf_field() }}
	<div class="form-group">
		<label>Nomor Mitra</label>
		<input type="text" name="idMitra" class="form-control" required ng-keyup="searchIDmitra()" ng-model="query" autocomplete="false">
		<ul class="hasilQuery">
			<li ng-repeat="i in arrayHasil">
				<a href="#" class="btn dropdown-item" ng-click="hasilQuery(i.id)">
					<% i.id %> - <% i.namaBadan %>
				</a>
			</li>
		</ul>
	</div>
	<div class="form-group border p-2" ng-repeat="i in permasalahan track by $index">
		<label><h5>Masalah <% $index+1 %></h5></label>
		<select class="form-control" name="jenis[]">
			<option>Jenis Masalah</option>
			<option value="Pemasaran">Pemasaran</option>
			<option value="Produksi">Produksi</option>
			<option value="Keuangan">Keuangan</option>
			<option value="SDM">SDM</option>
		</select>
		<textarea class="form-control" name="masalah[]"></textarea>
		<label>Konsultasi diarahkan ke:</label>
		<select class="form-control" name="konsultan[]">
			<option>Pilih Konsultan</option>
		</select>
	</div>
	<div class="form-group">
		<a class="btn btn-success" ng-click="tambahMasalah()">Tambah Masalah</a>
	</div>
</form>
@push('script')
	<script type="text/javascript">
		$(document).ready(function(){
			$(':required').each(function(e){
				$(this).parent('.form-group').find('label').addClass('required-form');
			});
			$('[name=idMitra]').on('focus',function(){
				$('.hasilQuery').fadeIn(100);
			});
			$('[name=idMitra]').on('focusout',function(){
				$('.hasilQuery').fadeOut(100);
			});
		});
		plutAPP.controller('form-pendataan-masalah',function($scope,$http){
			$scope.permasalahan = [];
			$scope.query = '';
			$scope.tambahMasalah = function(){
				$scope.permasalahan.push(1);
			}
			$scope.searchIDmitra = function(){
				console.log($scope.query);
				$http.get("{{route('mitra-cariid')}}?id="+$scope.query)
				.then(function(e){
					console.log(e.data);
					$scope.arrayHasil= e.data;
				});
			}
			$scope.hasilQuery = function(str){
				angular.element('[name=idMitra]').val(str);
				$scope.arrayHasil = [];
			}
		});
	</script>
@endpush