@push('css')
	.optional {
		display:none;
	}
	.required-form:after{
		content: " *";
		color: red;
	}
@endpush
<form class="col-12" method="POST" action="{{route('mitra-edit')}}" enctype="multipart/form-data">
	{{ csrf_field() }}
	<div class="form-group">
		<label>Nomor Mitra</label>
		<input type="hidden" name="id" value="<% mitraEdit.id %>" class="form-control">
	</div>
	<div class="form-group">
		<label>Nama Usaha</label>
		<input type="text" name="namaBadan" value="<% mitraEdit.namaBadan %>" class="form-control" required>
	</div>
	<div class="form-group">
		<label>Anggota Kelompok/Sentra</label>
		<input type="text" name="sentra" class="form-control" value="<% mitraEdit.sentra %>">
	</div>
	<div class="form-group">
		<label>Alamat Usaha</label>
		<textarea name="alamat" class="form-control" ng-bind="mitraEdit.alamat" required></textarea>
	</div>
	<div class="form-group">
		<label>Kabupaten</label>
		<select name="kabupaten" class="form-control" required="" ng-model="kabselected">
			<option value="">Pilih Kabupaten</option>
			<option ng-repeat="i in lokasi" value="<% i.id %>" ng-selected="mitraEdit.kabupaten == i.id "><% i.nama %></option>
		</select>
		<!-- <input type="text" name="kabupaten" class="form-control" required=""> -->
	</div>
	<div class="form-group">
		<label>Kecamatan</label>
		<select name="kecamatan" class="form-control" required="">
			<option value="">Pilih Kecamatan</option>
			<option ng-repeat="i in lokasi[kabselected-1].kecamatan" value="<% i.id %>" ng-selected="mitraEdit.kecamatan == i.id "><% i.kecamatan %></option>
			
		</select>
		<!-- <input type="text" name="kecamatan" class="form-control" required=""> -->
	</div>
	<div class="form-group">
		<label>Nama Pemilik</label>
		<input type="text" name="namaPemilik" class="form-control" value="<% mitraEdit.namaPemilik %>" required="">
	</div>
	<div class="form-group">
		<label>Telpon / HP</label>
		<input type="text" name="kontak" class="form-control" value="<% mitraEdit.kontak %>">
	</div>
	<div class="form-group">
		<label>Email</label>
		<input type="email" name="email" class="form-control" value="<% mitraEdit.email %>">
	</div>
	<div class="form-group">
		<label>Website</label>
		<input name="website" class="form-control" value="<% mitraEdit.website %>">
	</div>
	<div class="form-group">
		<label>NPWP</label>
		<input type="text" name="npwp" class="form-control" value="<% mitraEdit.npwp %>">
	</div>
	<div class="form-group">
		<label>Tahun Berdiri</label>
		<input type="number" name="tahun" class="form-control" value="<% mitraEdit.tahun %>">
	</div>
	<div class="form-group">
		<label>Status Usaha</label>
		<select name="status" class="form-control" required="">
			<option value="Owner" ng-selected="<% mitraEdit.status %>">Owner</option>
			<option value="Reseller" ng-selected="<% mitraEdit.status %>">Reseller</option>
			<option value="Dropshipper" ng-selected="<% mitraEdit.status %>">Dropshipper</option>
			<option value="Karyawan" ng-selected="<% mitraEdit.status %>">Karyawan</option>
		</select>
	</div>
	<div class="form-group">
		<label>Status Legalitas Usaha</label>
		<select name="legalitas" class="form-control" required="">
			@foreach($legalitas as $i)
				<option value="{{$i->nama}}">{{$i->nama}}</option>
			@endforeach
			<!-- <option value="Domisili" ng-selected="<% mitraEdit.legalitas %>">Domisili</option>
			<option value="Akta Pendirian" ng-selected="<% mitraEdit.legalitas %>">Akta Pendirian</option>
			<option value="SIUP" ng-selected="<% mitraEdit.legalitas %>">SIUP</option>
			<option value="TDP" ng-selected="<% mitraEdit.legalitas %>">TDP</option>
			<option value="IUMK" ng-selected="<% mitraEdit.legalitas %>">IUMK</option>
			<option value="Domisili" ng-selected="<% mitraEdit.legalitas %>">Belum Ada</option> -->
		</select>
	</div>
	<div class="form-group">
		<label>Modal Awal</label>
		<input type="number" name="modal" class="form-control" value="<% mitraEdit.modal %>">
	</div>
	<div class="form-group">
		<label>Total Asset</label>
		<input type="number" name="asset" class="form-control" value="<% mitraEdit.asset %>" placeholder="Nominal">
	</div>
	<div class="form-group">
		<label>Total Omset/Tahun</label>
		<input type="number" name="omset" class="form-control" value="<% mitraEdit.omset %>" placeholder="Nominal">
	</div>
	<div class="form-group">
		<label>Volume Usaha/Bulan</label>
		<input type="text" name="volume" class="form-control" value="<% mitraEdit.volume %>">
	</div>
	<div class="form-group">
		<p>Jumlah Karyawan</p>
		<label class="col-sm-2 col-form-label">Laki-laki</label>
		<div class="col-sm-8">
			<input type="number" name="karyawan_l" value="<% mitraEdit.karyawan_l %>" class="form-control">
		</div>
		<label class="col-sm-2 col-form-label">Perempuan </label>
		<div class="col-sm-8">
			<input type="number" name="karyawan_p" value="<% mitraEdit.karyawan_p %>" class="form-control">
		</div>
	</div>
	<div class="form-group">
		<label>Pelatihan</label>
		<textarea name="pelatihan" class="form-control"><% mitraEdit.pelatihan %></textarea>
	</div>
	<div class="form-group">
		<label>Gallery Produk</label>
		<select class="form-control" name="gallery">
			<option value="1" ng-selected="mitraEdit.gallery">Ya</option>
			<option value="0" ng-selected="!mitraEdit.gallery">Tidak</option>
		</select>
	</div>
	<div class="form-group">
		<label>Pustakapreneur</label>
		<select class="form-control" name="pustakapreneur">
			<option value="1" ng-selected="mitraEdit.pustakapreneur">Ya</option>
			<option value="0" ng-selected="!mitraEdit.pustakapreneur">Tidak</option>
		</select>
	</div>
</form>
@push('script')
	<script type="text/javascript">
		function autoaddfoto(){
			var copy = $(this).parent();
			var container = $(copy).parent();

			var cloned = $(copy).clone();
			var total = $('.produk').length;
			var inputan = cloned.find('.produk');
			
			cloned.find('.count').text(total+1);
			
			inputan.val('');
			inputan.on('change',autoaddfoto);
			
			cloned.appendTo(container);
		}
		$(document).ready(function(){
			$("[name=total_omset],[name=total_asset]").on('change',function(){
				var isian = $(this).parent().find('.optional');
				if($(this).val() == 'isi'){
					isian.show();
				}
				else {
					isian.hide();
				}
			});
			//$('.produk').on('change',autoaddfoto);
			$(':required').each(function(e){
				$(this).parent('.form-group').find('label').addClass('required-form');
			});
		});
	</script>
@endpush