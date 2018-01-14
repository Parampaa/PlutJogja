@push('css')
	.optional {
		display:none;
	}
	.required-form:after{
		content: " *";
		color: red;
	}
@endpush
<form class="col-12" method="POST" action="{{route('mitra-add')}}" enctype="multipart/form-data">
	{{ csrf_field() }}
	<div class="form-group">
		<label>Nama Usaha</label>
		<input type="text" name="namaBadan" class="form-control" required>
	</div>
	<div class="form-group">
		<label>Jenis Usaha</label>
		<select name="jenis" class="form-control">
			@foreach($jenisUsaha as $list)
			<option value="{{$list->id}}">{{ $list->nama }}</option>
			@endforeach
		</select>
	</div>
	<div class="form-group">
		<label>Anggota Kelompok/Sentra</label>
		<input type="text" name="sentra" class="form-control">
	</div>
	<div class="form-group">
		<label>Alamat Usaha</label>
		<textarea name="alamat" class="form-control" required></textarea>
	</div>
	<div class="form-group">
		<label>Kabupaten</label>
		<select name="kabupaten" class="form-control" required="" ng-model="kabselected">
			<option ng-repeat="i in lokasi" value="<% i.id %>"><% i.nama %></option>
		</select>
		<!-- <input type="text" name="kabupaten" class="form-control" required=""> -->
	</div>
	<div class="form-group">
		<label>Kecamatan</label>
		<select name="kecamatan" class="form-control" required="">
			<option ng-repeat="i in lokasi[kabselected-1].kecamatan" value="<% i.id %>"><% i.kecamatan %></option>
		</select>
		<!-- <input type="text" name="kecamatan" class="form-control" required=""> -->
	</div>
	<div class="form-group">
		<label>Nama Pemilik</label>
		<input type="text" name="namaPemilik" class="form-control" required="">
	</div>
	<div class="form-group">
		<label>Telpon / HP</label>
		<input type="text" name="kontak" class="form-control">
	</div>
	<div class="form-group">
		<label>Email</label>
		<input type="email" name="email" class="form-control">
	</div>
	<div class="form-group">
		<label>Website</label>
		<input name="website" class="form-control">
	</div>
	<div class="form-group">
		<label>NPWP</label>
		<input type="text" name="npwp" class="form-control">
	</div>
	<div class="form-group">
		<label>Tahun Berdiri</label>
		<input type="number" name="tahun" class="form-control">
	</div>
	<div class="form-group">
		<label>Status Usaha</label>
		<select name="status" class="form-control" required="">
			<option value="Owner">Owner</option>
			<option value="Reseller">Reseller</option>
			<option value="Dropshipper">Dropshipper</option>
			<option value="Karyawan">Karyawan</option>
		</select>
	</div>
	<div class="form-group">
		<label>Status Legalitas Usaha</label>
		<select name="legalitas" class="form-control" required="">
			<option value="Domisili">Domisili</option>
			<option value="Akta Pendirian">Akta Pendirian</option>
			<option value="SIUP">SIUP</option>
			<option value="TDP">TDP</option>
			<option value="IUMK">IUMK</option>
			<option value="Domisili">Belum Ada</option>
		</select>
	</div>
	<div class="form-group">
		<label>Modal Awal</label>
		<input type="number" name="modal" class="form-control">
	</div>
	<div class="form-group">
		<label>Total Asset</label>
		<select name="asset" class="form-control">
			<option value="mikro">Mikro < 50 juta</option>
			<option value="kecil">Kecil 50-500 juta</option>
			<option value="menengah">Menengah 500 juta - 10 M</option>
			<option value="isi">Lainnya</option>
		</select>
		<input type="number" name="asset_isian" class="form-control optional">
	</div>
	<div class="form-group">
		<label>Total Omset/Tahun</label>
		<select name="omset" class="form-control">
			<option value="mikro">Mikro < 300 juta</option>
			<option value="kecil">Kecil 300 juta - 2.5 M</option>
			<option value="menengah">Menengah 2.5 M - 50 M</option>
			<option value="isi">Lainnya</option>
		</select>
		<input type="number" name="omset_isian" class="form-control optional">
	</div>
	<div class="form-group">
		<label>Volume Usaha/Bulan</label>
		<input type="text" name="volume" class="form-control">
	</div>
	<div class="form-group">
		<p>Jumlah Karyawan</p>
		<label class="col-sm-2 col-form-label">Laki-laki</label>
		<div class="col-sm-8">
			<input type="number" name="karyawan_l" class="form-control">
		</div>
		<label class="col-sm-2 col-form-label">Perempuan </label>
		<div class="col-sm-8">
			<input type="number" name="karyawan_p" class="form-control">
		</div>
	</div>
	<div class="form-group">
		<div class="border p-5">
			<label>Foto Produk <span class="count"></span></label>
			<input type="file" class="produk form-control-file" name="fproduk[]" accept="image/*" multiple>
		</div>
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