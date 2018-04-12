<div id="mitra" class="mitra collapse show module p-5" ng-controller="mitra">
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
		<div class="d-flex justify-content-between py-3">
			<div class="d-flex flex-row">
				<button class="btn btn-success mx-2" data-target="#form-pendaftaran" data-toggle="modal">
					<i class="fa fa-address-card-o" aria-hidden="true"></i>
					Tambah
				</button>
				<button class="btn btn-warning mx-2" data-target="#form-pencarian" data-toggle="modal">
					<i class="fa fa-search" aria-hidden="true"></i>
					Pencarian
				</button>
			</div>
			<div>
				<span class="badge badge-dark"><% data.length %> Total data</span>
			</div>
			
			<div class="d-flex flex-row">
				<button class="btn btn-primary mx-2" ng-click="mitra__update__list()">
					<i class="fa fa-refresh" aria-hidden="true"></i>
					Refresh
				</button>
				<button class="btn btn-warning mx-2" data-target="#form-pengaturan" data-toggle="modal">
					<i class="fa fa-cog" aria-hidden="true"></i>
					Pengaturan
				</button>
			</div>
		</div>
		@include('table.list-mitra')
		@include('dialog.pendaftaran-mitra')
		@include('dialog.pengaturan-mitra')
		@include('dialog.penghapusan-mitra')
		@include('dialog.pencarian-mitra')
		@include('dialog.edit-mitra')
		@include('dialog.tampilan-produk')
		@include('dialog.tampilan-konsultasi')
		@include('dialog.tampilan-omset')
		<div class="scrollTop position-fixed" style="right: 50px; bottom: 50px;">
			<a href="#" ng-click="scrollTop()">
				<i class="fa fa-arrow-circle-up fa-3x" aria-hidden="true"></i>
			</a>
		</div>
	</div>
</div>
@push('script')
<script type="text/javascript">
	//mitra
	plutAPP.controller('mitra',function($scope,$http,$cookies){
		$scope.lokasi = JSON.parse('{!!$lokasi!!}');
		$scope.data = null;
		$scope.mitraShowLimit = 50;
		$scope.mitra__btn__save = function(e){
			//angular.element('.modal.show').find('form').submit();
			var data = $scope.getFormData(angular.element('.modal.show').find('form'));
			var dataform = new FormData();

			var files = angular.element('.modal.show form [type=file]');
			if(files){
				for(var i = 0; i < files.length;i++){
					dataform.append(files.eq(i).prop('name'),files[i].files[0]);
				}
			}

			for(var key in data){
				dataform.append(key,data[key]);
			}
			var rute = angular.element('.modal.show').find('form').prop('action');
			$http.post(rute,dataform,{
				transformRequest: angular.identity,
				headers:{'Content-Type':undefined}
			}).then(function(e){
				//$scope.mitra__tampilan_produk($scope.produkTampilan);
				
				if (e.data.error) {
					toastr.error(e.data.content,'Gagal');
				}
				else{
					toastr.success(angular.element('.modal.show .modal-title').text(),'Berhasil');
					angular.element('.modal.show').modal('hide');
				}

				$scope.mitra__update__list();
			}).catch(function(e){
				toastr.error('Gagal '+angular.element('.modal.show .modal-title').text(),'Gagal');
				console.log(e);
			});
		}
		
		$scope.mitra__update__list = function(){
			loading(true);
			$http.get('{{route("mitra-list")}}').then(function(e){
				
				$scope.data = $scope.dataShadow(e.data);
				
				setTimeout(function() {
					angular.element('.top-scrollbar').width(angular.element('table#data-mitra').outerWidth());
					loading(false);
				}, 500);
			});
		};

		$scope.mitra__conf_delete = function(id,data){
			angular.element('#form-penghapusan').modal('show');

			$scope.conf_del_id=id;
			$scope.conf_del_mitra=data;
		};
		$scope.mitra__delete = function(){
			// console.log(id);
			var id = $scope.conf_del_id;
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
				// console.log(e.data);
				$scope.mitraEdit = e.data;
				$scope.kabselected = $scope.mitraEdit.kabupaten;
				
				$http.get('{{route("mitra-produk")}}/?id='+id)
				.then(function(e){
					// console.log(e.data);
					$scope.mitraProduk = e.data;
				});
			});

		}
		$scope.filterFields = [];
		$scope.filterFields['field'] = [];
		$scope.dataShadow = function(e){
			var render = [];
			for(var i = 0 ; i < e.length ; i++){
				if(i < 50){
					render.push({
						data:e[i],
						show:true
					});
					//console.log(render[i]);
				}
				else{
					render.push({
						data:e[i],
						show:false
					});
				}
			}
			//console.log(render);
			return render;
		}
		$scope.filter =  function(field,operator,value){
			loading(true);
			if(value!=''){
				$scope.filterFields[field] = [operator,value];
				const index = $scope.filterFields.field.indexOf(field);
				if(index==-1)
					$scope.filterFields.field.push(field);

				$scope.filterExec($scope.filterURL());
			}
			else {
				const index = $scope.filterFields.field.indexOf(field);
				$scope.filterFields.field.splice(index,1);
				delete $scope.filterFields[field];
				if($scope.filterFields.field.length){
					$scope.filterExec($scope.filterURL());
				}
				else $scope.mitra__update__list();
			}
			
		}
		$scope.filterURL = function(){
			var str = [];
			$scope.filterFields.field.forEach(function(item,index){
				str.push('field[]='+item+'&operator[]='+$scope.filterFields[item][0]+'&value[]='+$scope.filterFields[item][1]);
			});
			return str.join("&");
		}
		$scope.filterExec = function(str){
			$http.get('{{route("mitra-list")}}?'+str).then(function(e){
					$scope.data = $scope.dataShadow( e.data );
					// console.log(str);
					setTimeout(function() {
						angular.element('.top-scrollbar').width(angular.element('table#data-mitra').outerWidth());
						loading(false);
					}, 500);
				});
		}
		$scope.modekonsultasi = 1;
		$scope.windowkonsultasi = function(type,data){
			$scope.modekonsultasi = type;
			$scope.selectedkonsultasi = data;
			console.log(angular.element('#tampilan-konsultasi form').offset().top);
			setTimeout(function() {
				angular.element('#tampilan-konsultasi').animate({
					scrollTop: angular.element('#pembataskonsultasi').offset().top+100
				});
			}, 100);
			
		}
		
		$scope.cancelkonsultasi = function(){
			$scope.modekonsultasi = 1;
		}

		$scope.mitra__konsultasi = function(data){
			$scope.konsultasiTampilan = data;
			$http.get('{{route("konsultasi-show")}}?mitra='+$scope.konsultasiTampilan.id).then(function(e){
				$scope.konsultasiTampilan['datakonsul']=e.data;
			});
			console.log($scope.konsultasiTampilan);
		}

		$scope.mitra__konsultasi_tambah = function(){
			var data = $scope.getFormData(angular.element('#form-tambah-konsultasi form'));
			var dataform = new FormData();

			for(var key in data){
				dataform.append(key,data[key]);
			}

			dataform.append('mitra',$scope.konsultasiTampilan.id);

			$http.post('{{route("konsultasi-add")}}',dataform,{
				transformRequest: angular.identity,
				headers:{'Content-Type':undefined}
			}).then(function(e){
				$scope.mitra__konsultasi($scope.konsultasiTampilan);
				toastr.success('Menambahkan Data Konsultasi','Berhasil');
			}).catch(function(e){
				toastr.error('Produk tidak dapat ditambahkan','Gagal');
				console.log(e);
			});

		}
		$scope.mitra__konsultasi_edit = function(){
			var data = $scope.getFormData(angular.element('#form-edit-konsultasi form'));
			var dataform = new FormData();

			for(var key in data){
				dataform.append(key,data[key]);
			}
			$http.post('{{route("konsultasi-edit")}}',dataform,{
				transformRequest: angular.identity,
				headers:{'Content-Type':undefined}
			}).then(function(e){
				$scope.mitra__konsultasi($scope.konsultasiTampilan);
				toastr.success('Mengubah Data Konsultasi','Berhasil');
				$scope.cancelkonsultasi();
			}).catch(function(e){
				toastr.error('Konsultasi tidak dapat ditambahkan','Gagal');
				console.log(e);
			});
		}
		$scope.mitra__konsultasi_delete = function(){
			var data = $scope.getFormData(angular.element('#form-hapus-konsultasi form'));
			var dataform = new FormData();

			for(var key in data){
				dataform.append(key,data[key]);
			}
			$http.post('{{route("konsultasi-delete")}}',dataform,{
				transformRequest: angular.identity,
				headers:{'Content-Type':undefined}
			}).then(function(e){
				$scope.mitra__konsultasi($scope.konsultasiTampilan);
				toastr.success('Data Dihapus','Berhasil');
				$scope.cancelkonsultasi();
			}).catch(function(e){
				toastr.error('Gagal Menghapus','Gagal');
				console.log(e);
			});
		}

		$scope.modeomset = 1;
		$scope.windowomset = function(type,data){
			$scope.modeomset = type;
			$scope.selectedomset = data;
			var waktu = new Date($scope.selectedomset.created_at);
			var hari = ('0'+waktu.getDate()).slice(-2);
			var bulan = ('0'+ (waktu.getMonth()+1) ).slice(-2);
			var tahun = waktu.getFullYear();
			$scope.selectedomset.time = tahun+'-'+bulan+'-'+hari;
			//console.log(angular.element('#tampilan-omset form').offset().top);
			console.log($scope.selectedomset.time);
			setTimeout(function() {
				angular.element('#tampilan-omset').animate({
					scrollTop: angular.element('#pembatasomset').offset().top+100
				});
			}, 100);
			
		}
		
		$scope.cancelomset = function(){
			$scope.modeomset = 1;
		}

		$scope.mitra__omset = function(data){
			$scope.omsetTampilan = data;
			$http.get('{{route("omset-show")}}?mitra='+$scope.omsetTampilan.id).then(function(e){
				$scope.omsetTampilan['dataomset']=e.data;
			});
			console.log($scope.omsetTampilan);
		}

		$scope.mitra__omset_tambah = function(){
			var data = $scope.getFormData(angular.element('#form-tambah-omset form'));
			var dataform = new FormData();

			for(var key in data){
				dataform.append(key,data[key]);
			}

			dataform.append('mitra',$scope.omsetTampilan.id);

			$http.post('{{route("omset-add")}}',dataform,{
				transformRequest: angular.identity,
				headers:{'Content-Type':undefined}
			}).then(function(e){
				$scope.mitra__omset($scope.omsetTampilan);
				toastr.success('Menambahkan Data omset','Berhasil');
			}).catch(function(e){
				toastr.error('Produk tidak dapat ditambahkan','Gagal');
				console.log(e);
			});

		}
		$scope.mitra__omset_edit = function(){
			var data = $scope.getFormData(angular.element('#form-edit-omset form'));
			var dataform = new FormData();

			for(var key in data){
				dataform.append(key,data[key]);
			}
			$http.post('{{route("omset-edit")}}',dataform,{
				transformRequest: angular.identity,
				headers:{'Content-Type':undefined}
			}).then(function(e){
				$scope.mitra__omset($scope.omsetTampilan);
				toastr.success('Mengubah Data omset','Berhasil');
				$scope.cancelomset();
			}).catch(function(e){
				toastr.error('omset tidak dapat ditambahkan','Gagal');
				console.log(e);
			});
		}
		$scope.mitra__omset_delete = function(){
			var data = $scope.getFormData(angular.element('#form-hapus-omset form'));
			var dataform = new FormData();

			for(var key in data){
				dataform.append(key,data[key]);
			}
			$http.post('{{route("omset-delete")}}',dataform,{
				transformRequest: angular.identity,
				headers:{'Content-Type':undefined}
			}).then(function(e){
				$scope.mitra__omset($scope.omsetTampilan);
				toastr.success('Data Dihapus','Berhasil');
				$scope.cancelomset();
			}).catch(function(e){
				toastr.error('Gagal Menghapus','Gagal');
				console.log(e);
			});
		}

		$scope.produk = [[1]];
		$scope.mitra__tampilan_produk = function(data){
			$scope.produkTampilan = data;
			$http.get('{{route("mitra-produk")}}/?id='+data.id).then(function(e){
				$scope.produkTampilan['daftar_produk'] = e.data;
				setTimeout(function() {
					$scope.$apply();
				}, 10);
			});
			console.log(data);
		}
		$scope.getFormData = function($form){
		    var unindexed_array = $form.serializeArray();
		    var indexed_array = {};

		    $.map(unindexed_array, function(n, i){
		        indexed_array[n['name']] = n['value'];
		    });

		    return indexed_array;
		}

		$scope.modeProduk = 1;
		$scope.windowProduk = function(type,data){
			$scope.modeProduk = type;
			$scope.selectedProduk = data;
			console.log(angular.element('#tampilan-produk form').offset().top);
			setTimeout(function() {
				angular.element('#tampilan-produk').animate({
					scrollTop: angular.element('#pembatasproduk').offset().top+100
				});
			}, 100);
			
		}
		$scope.tambahProduk = function(){
			var data = $scope.getFormData(angular.element('#form-tambah-produk form'));
			var dataform = new FormData();

			if(angular.element('#form-tambah-produk form [name=image]'))
				dataform.append('image',angular.element('#form-tambah-produk form [name=image]')[0].files[0]);

			for(var key in data){
				dataform.append(key,data[key]);
			}

			$http.post('{{route("mitra-produk-add")}}',dataform,{
				transformRequest: angular.identity,
				headers:{'Content-Type':undefined}
			}).then(function(e){
				$scope.mitra__tampilan_produk($scope.produkTampilan);
				toastr.success('Menambahkan produk','Berhasil');
			}).catch(function(e){
				toastr.error('Produk tidak dapat ditambahkan','Gagal');
			});
			//$scope.produk.push([1]);
		}
		$scope.editProduk = function(){
			var data = $scope.getFormData(angular.element('#form-edit-produk form'));
			var dataform = new FormData();

			if(angular.element('#form-edit-produk form [name=image]'))
				dataform.append('image',angular.element('#form-edit-produk form [name=image]')[0].files[0]);

			for(var key in data){
				dataform.append(key,data[key]);
			}

			$http.post('{{route("mitra-produk-edit")}}',dataform,{
				transformRequest: angular.identity,
				headers:{'Content-Type':undefined}
			}).then(function(e){
				$scope.mitra__tampilan_produk($scope.produkTampilan);
				toastr.success('Mengedit produk','Berhasil');
			});
			angular.element('#tampilan-produk').animate({
				scrollTop:0
			});
			$scope.modeProduk = 1;
		}
		$scope.deleteProduk = function(){
			var data = $scope.getFormData(angular.element('#form-hapus-produk form'));
			
			$http.post('{{route("mitra-produk-delete")}}',data).then(function(e){
				$scope.mitra__tampilan_produk($scope.produkTampilan);
				toastr.success('Menghapus produk','Berhasil');
			});
			angular.element('#tampilan-produk').animate({
				scrollTop:0
			});
			$scope.modeProduk = 1;
		}
		$scope.cancelProduk = function(){
			$scope.modeProduk = 1;
		}
		$scope.kriteria = [];
		$scope.tambahKriteria = function(){
			$scope.kriteria.push({id:null,label:'',batas_asset:0,batas_omset:0});
		}
		$http.get('{{route("kriteria-get")}}').then(function(e){
			$scope.kriteria = e.data;
			// console.log(e);
		});
		$scope.mitra__update__list();
		$scope.table_id=$cookies.get('table_id')?$cookies.get('table_id'):true;
	  	$scope.table_namaPemilik	= $cookies.get('table_namaPemilik')?$cookies.get('table_namaPemilik'):true;
	  	$scope.table_namaBadan		= $cookies.get('table_namaBadan')?$cookies.get('table_namaBadan'):true;
	  	$scope.table_jenis_usaha	= $cookies.get('table_jenis_usaha')?$cookies.get('table_jenis_usaha'):true;
	  	$scope.table_kecamatan		= $cookies.get('table_kecamatan')?$cookies.get('table_kecamatan'):true;
	  	$scope.table_kabupaten		= $cookies.get('table_kabupaten')?$cookies.get('table_kabupaten'):true;
	  	$scope.table_kontak			= $cookies.get('table_kontak')?$cookies.get('table_kontak'):true;
	  	$scope.table_status			= $cookies.get('table_status')?$cookies.get('table_status'):true;
	  	$scope.table_email			= $cookies.get('table_email')?$cookies.get('table_email'):true;
	  	$scope.table_website		= $cookies.get('table_website')?$cookies.get('table_website'):true;
	  	$scope.table_npwp			= $cookies.get('table_npwp')?$cookies.get('table_npwp'):true;
	  	$scope.table_legalitas		= $cookies.get('table_legalitas')?$cookies.get('table_legalitas'):true;
	  	$scope.table_sentra			= $cookies.get('table_sentra')?$cookies.get('table_sentra'):true;
	  	$scope.table_modal			= $cookies.get('table_modal')?$cookies.get('table_modal'):true;
	  	$scope.table_omset			= $cookies.get('table_omset')?$cookies.get('table_omset'):true;
	  	$scope.table_asset			= $cookies.get('table_asset')?$cookies.get('table_asset'):true;
	  	$scope.table_volume			= $cookies.get('table_volume')?$cookies.get('table_volume'):true;
	  	$scope.table_kriteria		= $cookies.get('table_kriteria')?$cookies.get('table_kriteria'):true;
	  	$scope.table_karyawan		= $cookies.get('table_karyawan')?$cookies.get('table_karyawan'):true;
	  	$scope.tampilanToggle = false;
	  	$scope.tampilanStatus = 0;
	  	$scope.setTampilan = function(type = null){
	  		
	  		if(type==1){
	  			angular.element('#tampilan_tab input').each(function(){
	  				if(angular.element(this).prop('checked') != $scope.tampilanToggle)
	  					angular.element(this).trigger('click');
	  			});
	  			setTimeout(function() {
	  				$scope.$apply();
	  			}, 10);
	  			$scope.tampilanToggle = !$scope.tampilanToggle;
	  			return;
	  		}
	  		$scope.setting = {
		  		table_id			:$scope.table_id,
			  	table_namaPemilik	:$scope.table_namaPemilik,
			  	table_namaBadan		:$scope.table_namaBadan,
			  	table_jenis_usaha	:$scope.table_jenis_usaha,
			  	table_kecamatan		:$scope.table_kecamatan,
			  	table_kabupaten		:$scope.table_kabupaten,
			  	table_kontak		:$scope.table_kontak,
			  	table_status		:$scope.table_status,
			  	table_email			:$scope.table_email,
			  	table_website		:$scope.table_website,
			  	table_npwp			:$scope.table_npwp,
			  	table_legalitas		:$scope.table_legalitas,
			  	table_sentra		:$scope.table_sentra,
			  	table_modal			:$scope.table_modal,
			  	table_omset			:$scope.table_omset,
			  	table_asset			:$scope.table_asset,
			  	table_volume		:$scope.table_volume,
			  	table_kriteria		:$scope.table_kriteria,
			  	table_karyawan		:$scope.table_karyawan,
			  	table_konsultasi	:$scope.table_konsultasi,
			  	table_pelatihan		:$scope.table_pelatihan,
			  	table_gallery		:$scope.table_gallery,
			  	table_pustakapreneur:$scope.table_pustakapreneur
		  	};
	  		for(var key in $scope.setting){
	  			$cookies.put(key,$scope.setting[key]);
	  			if($scope.setting[key]=='false' || $scope.setting[key] == false)
	  				$scope[key] = false;
	  			else
	  				$scope[key] = true;
	  		};
	  		if($scope.tampilanStatus){
	  			toastr.info('Berhasil menyimpan pengaturan tab tabel','Tampilan Tabel');
	  			angular.element('.modal.show').modal('hide');
	  		}
	  		$scope.tampilanStatus++;
	  	}
	  	$scope.setTampilan();
	  	$scope.export = function(){
	  		loading(true);
	  		var str_param = ['exportName='+$scope.exportName,'exportMode='+$scope.exportMode];
	  		str_param = str_param.join('&');
	  		if($scope.filterURL() && $scope.filterURL()!=''){
	  			str_param = '&' + str_param;
	  		}
	  		console.log('{{route("mitra-export")}}?'+$scope.filterURL()+str_param);
	  		window.open('{{route("mitra-export")}}?'+$scope.filterURL()+str_param,'_self');
	  	}
	  	$scope.scrolling = 0;
	  	$scope.treshold = [0.3,0.6];
	  	$scope.scrollTop = function(){
			var height = angular.element('html').height();
			angular.element('html,body').animate({scrollTop:0},200);
			while($scope.mitraShowLimit-50>=0){
				$scope.data[$scope.mitraShowLimit-50].show = true;
	  			$scope.data[$scope.mitraShowLimit].show = false;
	  			$scope.mitraShowLimit--;
	  		}
	  		setTimeout(function() {
	  			$scope.$apply();
	  		}, 100);
		}
		$scope.mitra__reset = function(){
			for (var fields in $scope.filterFields.field){
				const index = $scope.filterFields.field.indexOf(fields);
				$scope.filterFields.field.splice(index,1);
				delete $scope.filterFields[fields];
			}
			$scope.filterExec($scope.filterURL());
		}
		$scope.mitra__field_check = function(field){
			if(!$scope.mitra__field_search[field]){
				console.log(field);
				const index = $scope.filterFields.field.indexOf(field);
				if(index != -1){
					$scope.filterFields.field.splice(index,1);
					delete $scope.filterFields[field];
				}
			}
			
		}

		$scope.tambahJenis = function(){
			var el 		= angular.element('.template_jenis_umkm');
			var index   = el.length-1;
			var copy    = el.eq(0).clone();
			copy.find('label').text('Jenis Usaha '+(index+2));
			copy.find('input').each(function(){
				angular.element(this).val('');
			});
			copy.find('textarea').each(function(){
				angular.element(this).html('');
			});
			copy.insertAfter(el.eq(index));
		}
		$scope.tambahLegalitas = function(){
			var el 		= angular.element('.template_legalitas_umkm');
			var index   = el.length-1;
			var copy    = el.eq(0).clone();
			copy.find('label').text('Jenis Legalitas '+(index+2));
			copy.find('input').each(function(){
				angular.element(this).val('');
			});
			copy.find('textarea').each(function(){
				angular.element(this).html('');
			});
			copy.insertAfter(el.eq(index));
		}
		$scope.mitra__search = function(){
			loading(true);
			for (var fields in $scope.mitra__field_search){
				if($scope.mitra__field_search[fields]){
					$scope.filterFields[fields] = ['like',encodeURI($scope.mitra__keyword)];
					const index = $scope.filterFields.field.indexOf(fields);
					if(index==-1){
						$scope.filterFields.field.push(fields);
					}
				}
				
			}
			$scope.filterExec($scope.filterURL());
		}
		$scope.scrolled = false;
	  	angular.element(window).on('scroll',function(e){
	  		var posisi = angular.element(document).scrollTop();
	  		var tinggi = angular.element(document).height();
	  		var scrollBlock = 8;
	  		if(posisi <= 50 && $scope.scrolled){
	  			loading(true);
	  			while($scope.mitraShowLimit-50>0 && $scope.data.length){
					$scope.data[$scope.mitraShowLimit-50].show = true;
		  			$scope.data[$scope.mitraShowLimit].show = false;
		  			$scope.mitraShowLimit--;
		  		}
		  		setTimeout(function() {
		  			$scope.$apply();
		  			loading(false);
		  		}, 100);
		  		$scope.scrolled = false;
	  		}
	  		if(posisi > tinggi*$scope.treshold[1] && $scope.data && $scope.data.length && $scope.data.length > $scope.mitraShowLimit){
	  			var i = 0;
	  			for (i = 0 ; i < scrollBlock; i++) {
	  				var pos = $scope.mitraShowLimit+i;
	  				if(pos-50 >= 0 &&  pos-50 < $scope.data.length)
	  					$scope.data[pos-50].show = false;
	  				if (pos >=0 && pos < $scope.data.length)
	  					$scope.data[pos].show = true;
	  			}
	  			$scope.mitraShowLimit+= i;
	  			$scope.$apply();
	  			$scope.scrolled = true;
	  		}

	  		else if(posisi < tinggi*$scope.treshold[0] && $scope.mitraShowLimit >= 50 && $scope.scrolled){
	  			var i = 0;
	  			for (i = 0 ; i < scrollBlock; i++) {
	  				var pos = $scope.mitraShowLimit+i;
	  				if(pos-50 >= 0 &&  pos-50 < $scope.data.length)
	  					$scope.data[pos-50].show = true;
	  				if (pos >=0 && pos < $scope.data.length)
	  					$scope.data[pos].show = false;
	  			}
	  			$scope.mitraShowLimit-= $scope.mitraShowLimit-i < 50?0:i;
	  			$scope.$apply();
	  		}
	  		else{
	  	
	  		}
	  		var tfoot_left = angular.element('#data-mitra thead').offset().left;
			angular.element('#data-mitra tfoot td').each(function(index){
				angular.element(this).css('width',angular.element('#data-mitra thead td').eq(index).outerWidth());
				angular.element(this).css('display','inline-block');
			});
			angular.element('#data-mitra tfoot').css('width',angular.element('#data-mitra thead').outerWidth());
			angular.element('#data-mitra tfoot').css('left',tfoot_left-$(this).scrollLeft());
	  	});
	});

</script>
@endpush