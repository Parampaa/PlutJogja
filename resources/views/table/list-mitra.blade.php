@push('css')
	.top-scrollbar-wrapper{
		width:100%;
		overflow-x:auto;
		height:20px;
		overflow-y:hidden;
	}
	.top-scrollbar{
		height:20px;
	}
	.allborderlr td {
		border-left: 1px solid #CCC;
		border-right: 1px solid #CCC;
	}
	tbody tr:hover td{
		background-color:#ffeaa7;
	}

@endpush
<div class="top-scrollbar-wrapper">
	<div class="top-scrollbar"></div>
</div>
<div class="table-responsive" style="overflow: auto;">
<table id="data-mitra" class="table">
	<thead style="background-color: #2c3e50; color: white" class="text-center">
		<tr>
			<td>No</td>
			<td ng-show="table_id">No Mitra</td>
			<td ng-show="table_namaPemilik">Nama Pemilik</td>
			<td ng-show="table_namaBadan">Nama Usaha</td>
			<td ng-show="table_jenis_usaha">
				<select class="form-control" ng-change="filter('jenis','=',filterJen)" ng-model="filterJen">
					<option value="">Jenis Usaha</option>
					@foreach($jenisUsaha as $list)
					<option value="{{$list->id}}">{{ $list->nama }}</option>
					@endforeach
				</select>
			</td>
			<td ng-show="table_kecamatan">
				<select class="form-control" ng-change="filter('kecamatan','=',filterKec)" ng-model="filterKec">
					<option value="">Kecamatan</option>
					<optgroup ng-repeat="i in lokasi" label="<% i.nama %>">
						<option ng-repeat="j in i.kecamatan" value="<% j.id %>"><% j.kecamatan %></option>
					</optgroup>
				</select>
			</td>
			<td ng-show="table_kabupaten">
				<select class="form-control" ng-change="filter('kabupaten','=',filterKab)" ng-model="filterKab">
					<option value="">Kabupaten</option>
					<option ng-repeat="i in lokasi" value="<% i.id %>"><% i.nama %></option>
				</select>
			</td>
			<td ng-show="table_kontak">Kontak</td>
			<td ng-show="table_status">
				<select class="form-control" ng-change="filter('status','like','%'+filterStat+'%')" ng-model="filterStat">
					<option value="">Status...</option>
					<option value="Owner">Owner</option>
					<option value="Reseller">Reseller</option>
					<option value="Dropshipper">Dropshipper</option>
					<option value="Karyawan">Karyawan</option>
				</select>
			</td>
			<td ng-show="table_email">Email</td>
			<td ng-show="table_website">Website</td>
			<td ng-show="table_npwp">NPWP</td>
			<td ng-show="table_legalitas">
				<select class="form-control " ng-change="filter('legalitas','=',filterLeg)" ng-model="filterLeg">
					<option value="">Legalitas</option>
					<option value="Domisili">Domisili</option>
					<option value="Akta Pendirian">Akta Pendirian</option>
					<option value="SIUP">SIUP</option>
					<option value="TDP">TDP</option>
					<option value="IUMK">IUMK</option>
					<option value="Belum Ada">Belum Ada</option>
				</select>
			</td>
			<td ng-show="table_sentra">Sentra</td>
			<td ng-show="table_modal">Modal</td>
			<td ng-show="table_omset">Omset</td>
			<td ng-show="table_asset">Asset</td>
			<td ng-show="table_volume">Volume</td>
			<td ng-show="table_kriteria">
				<select class="form-control" ng-change="filter('kriteria','=',filterKrit)" ng-model="filterKrit">
					<option value="">Kriteria</option>
					<option ng-repeat="i in kriteria" value="<% i.label %>"><% i.label %></option>
				</select>
			</td>
			<td ng-show="table_karyawan">Karyawan</td>
			<td ng-show="table_konsultasi">Konsultasi</td>
			<td ng-show="table_pelatihan">Pelatihan</td>
			<td ng-show="table_gallery">Gallery Produk</td>
			<td ng-show="table_pustakapreneur">Pustakapreneur</td>
			<td>Produk</td>
			<td>Aksi</td>
		</tr>
	</thead>
	<tbody class="text-nowrap">
		<tr ng-show="!data.length">
			<td colspan="19" class="text-center">- - - - Kosong - - - -</td>
		</tr>
		<tr ng-repeat="mitra in data | filter : { show : true } " class="allborderlr">
			<td><% mitraShowLimit+$index-49 %></td>
			<td ng-show="table_id"><% mitra.data.id %></td>
			<td ng-show="table_namaPemilik"><% mitra.data.namaPemilik %></td>
			<td ng-show="table_namaBadan"><% mitra.data.namaBadan %></td>
			<td ng-show="table_jenis_usaha">
				<span ng-repeat="i in mitra.data.jenis_usaha"><% i.nama %></span>
			</td>
			<td ng-show="table_kecamatan"><% mitra.data.asal_kecamatan.kecamatan %></td>
			<td ng-show="table_kabupaten"><% mitra.data.asal_kabupaten.nama %></td>
			<td ng-show="table_kontak"><% mitra.data.kontak %></td>
			<td ng-show="table_status"><% mitra.data.status %></td>
			<td ng-show="table_email"><% mitra.data.email %></td>
			<td ng-show="table_website"><% mitra.data.website %></td>
			<td ng-show="table_npwp"><% mitra.data.npwp %></td>
			<td ng-show="table_legalitas"><% mitra.data.legalitas %></td>
			<td ng-show="table_sentra"><% mitra.data.sentra %></td>
			<td ng-show="table_modal"><% ( mitra.data.modal || 0 ) | currency : "Rp " : 2 %></td>
			<td ng-show="table_omset">
				<div><% ( mitra.data.omset || 0 ) | currency : "Rp " : 2 %></div>
				<button class="btn btn-primary" ng-click="mitra__omset(mitra.data)" data-target="#tampilan-omset" data-toggle="modal">Omset</button>
			</td>
			<td ng-show="table_asset"><% ( mitra.data.asset || 0 ) | currency : "Rp " : 2 %></td>
			<td ng-show="table_volume"><% mitra.data.volume %></td>
			<td ng-show="table_kriteria"><% mitra.data.kriteria %></td>
			<td ng-show="table_karyawan">
				<% mitra.data.total_karyawan || 0 %> Karyawan
				[ <% mitra.data.karyawan_l %> L / <% mitra.data.karyawan_p %> P ]
			</td>
			<td ng-show="table_konsultasi">
				<button class="btn btn-primary" ng-click="mitra__konsultasi(mitra.data)" data-target="#tampilan-konsultasi" data-toggle="modal">Konsultasi</button>		
			</td>
			<td ng-show="table_pelatihan"><% mitra.data.pelatihan || '-' %></td>
			<td ng-show="table_gallery">
				<i class="fa fa-check-square text-success" aria-hidden="true" ng-show="mitra.data.gallery"></i>
				<i class="fa fa-times text-danger" aria-hidden="true" ng-show="!mitra.data.gallery"></i>
			</td>
			<td ng-show="table_pustakapreneur">
				<i class="fa fa-check-square text-success" aria-hidden="true" ng-show="mitra.data.pustakapreneur"></i>
				<i class="fa fa-times text-danger" aria-hidden="true" ng-show="!mitra.data.pustakapreneur"></i>
			</td>
			<td>
				<a class="btn btn-primary" href="" ng-click="mitra__tampilan_produk(mitra.data)" data-target="#tampilan-produk" data-toggle="modal">Lihat Produk</a>
			</td>
			<td>
				<a class="btn btn-warning" href="" ng-click="mitra__edit(mitra.data.id)" data-target="#form-edit" data-toggle="modal">Edit</a>
				<a class="btn btn-danger" href="" ng-click="mitra__conf_delete(mitra.data.id,mitra.data)">Hapus</a>
			</td>
		</tr>
	</tbody>
	<tfoot style="background-color: #2c3e50; color: white;top:0;" class="text-center">
		<tr class="d-inline-flex">
			<td>No</td>
			<td ng-show="table_id">No Mitra</td>
			<td ng-show="table_namaPemilik">Nama Pemilik</td>
			<td ng-show="table_namaBadan">Nama Usaha</td>
			<td ng-show="table_jenis_usaha">
				<select class="form-control" ng-change="filter('jenis','=',filterJen)" ng-model="filterJen">
					<option value="">Jenis Usaha</option>
					@foreach($jenisUsaha as $list)
					<option value="{{$list->id}}">{{ $list->nama }}</option>
					@endforeach
				</select>
			</td>
			<td ng-show="table_kecamatan">
				<select class="form-control" ng-change="filter('kecamatan','=',filterKec)" ng-model="filterKec">
					<option value="">Kecamatan</option>
					<optgroup ng-repeat="i in lokasi" label="<% i.nama %>">
						<option ng-repeat="j in i.kecamatan" value="<% j.id %>"><% j.kecamatan %></option>
					</optgroup>
				</select>
			</td>
			<td ng-show="table_kabupaten">
				<select class="form-control" ng-change="filter('kabupaten','=',filterKab)" ng-model="filterKab">
					<option value="">Kabupaten</option>
					<option ng-repeat="i in lokasi" value="<% i.id %>"><% i.nama %></option>
				</select>
			</td>
			<td ng-show="table_kontak">Kontak</td>
			<td ng-show="table_status">
				<select class="form-control" ng-change="filter('status','=',filterStat)" ng-model="filterStat">
					<option value="">Status...</option>
					<option value="Owner">Owner</option>
					<option value="Reseller">Reseller</option>
					<option value="Dropshipper">Dropshipper</option>
					<option value="Karyawan">Karyawan</option>
				</select>
			</td>
			<td ng-show="table_email">Email</td>
			<td ng-show="table_website">Website</td>
			<td ng-show="table_npwp">NPWP</td>
			<td ng-show="table_legalitas">
				<select class="form-control " ng-change="filter('legalitas','=',filterLeg)" ng-model="filterLeg">
					<option value="">Legalitas</option>
					<option value="Domisili">Domisili</option>
					<option value="Akta Pendirian">Akta Pendirian</option>
					<option value="SIUP">SIUP</option>
					<option value="TDP">TDP</option>
					<option value="IUMK">IUMK</option>
					<option value="Belum Ada">Belum Ada</option>
				</select>
			</td>
			<td ng-show="table_sentra">Sentra</td>
			<td ng-show="table_modal">Modal</td>
			<td ng-show="table_omset">Omset</td>
			<td ng-show="table_asset">Asset</td>
			<td ng-show="table_volume">Volume</td>
			<td ng-show="table_kriteria">
				<select class="form-control" ng-change="filter('kriteria','=',filterKrit)" ng-model="filterKrit">
					<option value="">Kriteria</option>
					<option ng-repeat="i in kriteria" value="<% i.label %>"><% i.label %></option>
				</select>
			</td>
			<td ng-show="table_karyawan">Karyawan</td>
			<td ng-show="table_konsultasi">Konsultasi</td>
			<td ng-show="table_pelatihan">Pelatihan</td>
			<td ng-show="table_gallery">Gallery Produk</td>
			<td ng-show="table_pustakapreneur">Pustakapreneur</td>
			<td>Produk</td>
			<td>Aksi</td>
		</tr>
	</tfoot>
</table>
</div>

@push('script')
	<script type="text/javascript">
		var shift = false;
		$(document).keydown(function(e){
			if(e.originalEvent.keyCode == 16){
				shift = true;
			}
		});
		$(document).keyup(function(e){
			if(e.originalEvent.keyCode == 16){
				shift = false;
			}
		});

		$(document).on('scroll',function(){
			if($('#data-mitra thead').offset().top+50 < $(this).scrollTop()){
				$('#data-mitra tfoot').show();
			}
			else if($('#data-mitra thead').offset().top+50 >= $(this).scrollTop()){
				$('#data-mitra tfoot').hide();
			}
		});
		
		setTimeout(function() {
			$('#data-mitra tfoot').css({
				'position':'fixed',
				'top'	:'0',
				'display':'none'
			});
		}, 1000);

		$('.top-scrollbar').width($('table#data-mitra').width());
		
		var dragged = false;
		
		$('.top-scrollbar-wrapper').on('mousedown',function(){
			dragged = true;
		});
		$('.top-scrollbar-wrapper').on('mouseup',function(){
			dragged = false;
		});
		$('.top-scrollbar-wrapper').on('scroll',function(){
			if(dragged)
				$('.table-responsive').scrollLeft($(this).scrollLeft());
		});
		var before = $('.table-responsive').scrollLeft();
		$('.table-responsive').on('scroll',function(){
			var skrng = $('.table-responsive').scrollLeft();
			if(shift || before != skrng){
				$('.table-responsive').scrollLeft($(this).scrollLeft());
				$('.top-scrollbar-wrapper').scrollLeft($(this).scrollLeft());
				$('#data-mitra tfoot').css('left',$(this).offset().left-$(this).scrollLeft());
				before = skrng;
			}
			else{
				$('.top-scrollbar-wrapper').scrollLeft($(this).scrollLeft());
			}
		});
		// $(document).on('scroll',function(){
		// 	var scrollTop =$('.top-scrollbar-wrapper');
		// 	var pos = $(window).scrollTop();
		// 	if(pos > scrollTop.offset().top){
		// 		$scope.scrolling = scrollTop.offset().top;
		// 		scrollTop.offset({top:pos});
		// 		scrollTop.addClass('position-fixed');
		// 	}
		// 	else if(pos < $scope.scrolling){
		// 		scrollTop.removeClass('position-fixed');
		// 		scrollTop.offset({top:scrollTop});
		// 	}
		// 	console.log(scrollTop.offset().top + " " +pos);
		// });
		
	</script>
@endpush