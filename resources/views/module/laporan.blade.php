<div id="laporan" class="laporan collapse module p-5" ng-controller="laporan">
	<div class="header">
		<h3 class="display-3 text-center">Rekap & Laporan PLUT</h3>
	</div>
	<div class="body">
		<form>
			<div class="form-group">
				<label>Laporan Berdasarkan Waktu</label>
				<div class="p-5">
					<canvas id="visualization_waktu" width="400" height="200" class="chart chart-line" chart-data="waktu.datasets" chart-labels="waktu.label" chart-options="waktu.option"></canvas>
				</div>
				<select class="form-control" name="id">
					@foreach($years as $year)
					<option value="%.{{$year}}.%">Tahun {{$year}}</option>
						<optgroup label="{{$year}}">
						@foreach($months as $month)
							<option value="%.{{$year}}.{{ str_pad( $loop->index+1, 2, '0', STR_PAD_LEFT) }}">{{$month.' '.$year}}</option>
						@endforeach
						</optgroup>
					@endforeach
				</select>
				<button class="btn btn-success" type="button">Download</button>
			</div>
		</form>
		<form>
			<div class="form-group">
				<label>Laporan Berdasarkan Kecamatan</label>
				<div class="p-5">
					<canvas id="visualization_kec" width="400" height="200" class="chart chart-pie" chart-data="kec.datasets" chart-labels="kec.label" chart-options="kec.option"></canvas>
				</div>
				<select name="kecamatan" class="form-control">
					@foreach($lokasiArr as $kab)
						<optgroup label="{{$kab['nama']}}">
							@foreach($kab->kecamatan as $kec)
								<option value="{{$kec['id']}}">{{$kec['kecamatan']}}</option>
							@endforeach
						</optgroup>
					@endforeach
				</select>
				<button class="btn btn-success" type="button">Download</button>
			</div>
		</form>
		<form>
			<div class="form-group">
				<label>Laporan Berdasarkan Kabupaten</label>
				<div class="p-5">
					<canvas id="visualization_area" width="400" height="200" class="chart chart-pie" chart-data="area.datasets" chart-labels="area.label" chart-options="area.option"></canvas>
				</div>
				<select name="kabupaten" class="form-control">
					@foreach($lokasiArr as $kab)
						<option value="{{$kab['id']}}">{{$kab['nama']}}</option>
					@endforeach
				</select>
				<button class="btn btn-success" type="button">Download</button>
			</div>
		</form>
		<form>
			<div class="form-group">
				<label>Laporan Berdasarkan Kriteria UMKM</label>
				<div class="p-5">
					<canvas id="visualization_category" width="400" height="200" class="chart chart-pie" chart-data="category.datasets" chart-labels="category.label"  chart-options="category.option"></canvas>
				</div>
				<select name="kriteria" class="form-control">
					@foreach($kriteria as $i)
						<option value="{{$i->label}}">{{$i->label}}</option>
					@endforeach
				</select>
				<button class="btn btn-success" type="button">Download</button>
			</div>
		</form>
	</div>
</div>
@push('script')
<script type="text/javascript">
	//anggota
	plutAPP.controller('laporan',function($scope,$http){
		$scope.lokasi = JSON.parse('{!!$lokasi!!}');
		angular.element('#laporan [type=button]').click(function(){
			var data = angular.element(this).parents('form').find('select');
			var title = encodeURI(angular.element(this).parents('form').find('label').text());
			var str_param = [
				'exportName='+title,
				'exportMode=x',
				'field[]='+data.prop('name'),
				'operator[]=like',
				'value[]='+data.val()
			];
	  		str_param = str_param.join('&');
	  		url = '{{route("mitra-export")}}?'+str_param;
	  		window.open(url,'_self');
		});
		
		$http.get('{{route("laporan-timeline")}}').then(function(e){
			$scope.waktu = e.data;

			$scope.waktu.option={

					title	: {
						display : true,
						text    : "Grafik UMKM yang Terdaftar Menurut Tahun Pendaftaran"
					},
					scales: {
			            yAxes: [{
			                ticks: {
			                    min: 0,
			              		max: $scope.waktu.datasets[$scope.waktu.datasets.length-2]+500
			                }
			            }]
			        }

			};
		});
		$http.get('{{route("laporan-area")}}').then(function(e){
			$scope.area = e.data;
			$scope.area.option={

					title	: {
						display : true,
						text    : "Komposisi UMKM Berdasarkan Kabupaten"
					},
					legend 	: {
						display : true
					}

			};
		});
		$http.get('{{route("laporan-kec")}}').then(function(e){
			$scope.kec = e.data;
			$scope.kec.option={

					title	: {
						display : true,
						text    : "Komposisi UMKM Berdasarkan Kecamatan"
					},
					legend 	: {
						display : true,
						position: 'bottom'
					}

			};
		});
		$http.get('{{route("laporan-category")}}').then(function(e){
			$scope.category = e.data;
			$scope.category.option={

					title	: {
						display : true,
						text    : "Komposisi Kriteria UMKM"
					},
					legend 	: {
						display : true,
					}

			};
		});
	});
</script>
@endpush