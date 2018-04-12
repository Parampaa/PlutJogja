@push('css')
	.optional {
		display:none;
	}
	.required-form:after{
		content: " *";
		color: red;
	}
	.form-head {
		background: #34495e;
		color: #f1c40f;
		padding: 5px;
		width:100%;
	}
@endpush
<form class="col-12" method="POST" action="{{route('mitra-add')}}" enctype="multipart/form-data">
	{{ csrf_field() }}
	<div class="form-group">
		<label class="form-head">Nama Usaha</label>
		<input type="text" name="namaBadan" class="form-control" required>
	</div>
	<div class="form-group p-3 border" ng-repeat="i in produk track by $index">
		<label class="form-head">Nama Produk <% $index+1 %></label>
		<input type="text" name="nproduk[]" class="form-control">
		<hr>
		<label class="form-head">Jenis Usaha Produk <% $index+1 %></label>
		<select name="jenis[]" class="form-control">
			@foreach($jenisUsaha as $list)
			<option value="{{$list->id}}">{{ $list->nama }}</option>
			@endforeach
		</select>
		<div class="border p-5">
			<label class="form-head">Foto Produk <% $index+1 %><span class="count"></span></label>
			<input type="file" class="produk form-control-file" name="fproduk[]" accept="image/*">
		</div>
	</div>
	<div class="form-group">
		<button type="button" class="btn btn-success" ng-click="tambahProduk()">Tambah Produk</button>
	</div>
	<div class="form-group">
		<label class="form-head">Anggota Kelompok/Sentra</label>
		<input type="text" name="sentra" class="form-control">
	</div>
	<div class="form-group">
		<label class="form-head">Alamat Usaha</label>
		<textarea name="alamat" class="form-control" required></textarea>
	</div>
	<div class="form-group">
		<label class="form-head">Kabupaten</label>
		<select name="kabupaten" class="form-control" required="" ng-model="kabselected">
			<option ng-repeat="i in lokasi" value="<% i.id %>"><% i.nama %></option>
		</select>
		<!-- <input type="text" name="kabupaten" class="form-control" required=""> -->
	</div>
	<div class="form-group">
		<label class="form-head">Kecamatan</label>
		<select name="kecamatan" class="form-control" required="">
			<option ng-repeat="i in lokasi[kabselected-1].kecamatan" value="<% i.id %>"><% i.kecamatan %></option>
		</select>
		<!-- <input type="text" name="kecamatan" class="form-control" required=""> -->
	</div>
	<div class="form-group">
		<label class="form-head">Nama Pemilik</label>
		<input type="text" name="namaPemilik" class="form-control" required="">
	</div>
	<div class="form-group">
		<label class="form-head">Telpon / HP</label>
		<input type="text" name="kontak" class="form-control">
	</div>
	<div class="form-group">
		<label class="form-head">Email</label>
		<input type="email" name="email" class="form-control">
	</div>
	<div class="form-group">
		<label class="form-head">Website</label>
		<input name="website" class="form-control">
	</div>
	<div class="form-group">
		<label class="form-head">NPWP</label>
		<input type="text" name="npwp" class="form-control">
	</div>
	<div class="form-group">
		<label class="form-head">Tahun Berdiri</label>
		<input type="number" name="tahun" class="form-control">
	</div>
	<div class="form-group">
		<label class="form-head">Status Usaha</label>
		<select name="status" class="form-control" required="">
			<option value="Owner">Owner</option>
			<option value="Reseller">Reseller</option>
			<option value="Dropshipper">Dropshipper</option>
			<option value="Karyawan">Karyawan</option>
		</select>
	</div>
	<div class="form-group">
		<label class="form-head">Status Legalitas Usaha</label>
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
		<label class="form-head">Modal Awal</label>
		<input type="number" name="modal" class="form-control">
	</div>
	<div class="form-group">
		<label class="form-head">Total Asset</label>
		<input type="number" name="asset" class="form-control" placeholder="Nominal">
	</div>
	<div class="form-group">
		<label class="form-head">Total Omset/Tahun</label>
		<input type="number" name="omset" class="form-control" placeholder="Nominal">
	</div>
	<div class="form-group">
		<label class="form-head">Volume Usaha/Bulan</label>
		<input type="text" name="volume" class="form-control">
	</div>
	<div class="form-group">
		<p class="form-head">Jumlah Karyawan</p>
		<label>Laki-laki</label>
		<div>
			<input type="number" name="karyawan_l" class="form-control">
		</div>
		<label>Perempuan </label>
		<div>
			<input type="number" name="karyawan_p" class="form-control">
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
			$("[name=omset],[name=asset]").on('change',function(){
				var isian = $(this).parent().find('.optional');
				if($(this).val() == 'isi'){
					isian.show();
				}
				else {
					isian.hide();
				}
			});
			$(':required').each(function(e){
				$(this).parent('.form-group').find('label').addClass('required-form');
			});
		});
	</script>
@endpush