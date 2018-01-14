@extends('layouts.appV1')

@section('custom-css')
	.optional {
		display:none;
	}
@endsection

@section('content')
	<div class="container py-5">
		<div class="row d-flex justify-content-center p-3">
			<div class="">
				<img src="{{asset('img/matausaha.png')}}" class="img-thumbnail" width="250px" height="15px">
			</div>
		</div>
		<div class="row">
			<div class="header font-weight-bold text-center w-100 p-3">
				<p>FORMULIR DATA UMKM</p>
				<p>MITRA BINAAN PROGRAM KEMITRAAN BINA LINGKUNGAN (PKBL)</p>
			</div>
		</div>
		<div class="row">
			<form class="col-12" method="POST" action="{{ route('form-pkbl') }}" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="form-group">
					<label>Nama Usaha</label>
					<input type="text" name="nama_usaha" class="form-control">
				</div>
				<div class="form-group">
					<label>Jenis Usaha</label>
					<input type="text" name="jenis_usaha" class="form-control">
				</div>
				<div class="form-group">
					<label>Anggota Kelompok/Sentra</label>
					<input type="text" name="kelompok_usaha" class="form-control">
				</div>
				<div class="form-group">
					<label>Alamat Usaha</label>
					<textarea name="alamat_usaha" class="form-control"></textarea>
				</div>
				<div class="form-group">
					<label>Nama Pemilik</label>
					<input type="text" name="nama_pemilik" class="form-control">
				</div>
				<div class="form-group">
					<label>Telpon / HP</label>
					<input type="text" name="telp" class="form-control">
				</div>
				<div class="form-group">
					<label>Tahun Berdiri</label>
					<input type="number" name="tahun" class="form-control">
				</div>
				<div class="form-group">
					<label>Modal Awal</label>
					<input type="number" name="modal" class="form-control">
				</div>
				<div class="form-group">
					<label>Total Asset</label>
					<select name="total_asset" class="form-control">
						<option value="mikro">Mikro < 50 juta</option>
						<option value="kecil">Kecil 50-500 juta</option>
						<option value="menengah">Menengah 500 juta - 10 M</option>
						<option value="isi">Lainnya</option>
					</select>
					<input type="number" name="total_asset_isian" class="form-control optional">
				</div>
				<div class="form-group">
					<label>Total Omset/Tahun</label>
					<select name="total_omset" class="form-control">
						<option value="mikro">Mikro < 300 juta</option>
						<option value="kecil">Kecil 300 juta - 2.5 M</option>
						<option value="menengah">Menengah 2.5 M - 50 M</option>
						<option value="isi">Lainnya</option>
					</select>
					<input type="number" name="total_omset_isian" class="form-control optional">
				</div>
				<div class="form-group">
					<p>Jumlah Karyawan</p>
					<label class="col-sm-2 col-form-label">Laki-laki</label>
					<div class="col-sm-8">
						<input type="number" name="karyawan_laki" class="form-control">
					</div>
					<label class="col-sm-2 col-form-label">Perempuan </label>
					<div class="col-sm-8">
						<input type="number" name="karyawan_perempuan" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<div class="border p-5">
						<label>Foto Produk <span class="count">1</span></label>
						<input type="file" class="produk form-control-file" name="fproduk[]" accept="image/*">
					</div>
				</div>
				<div class=" d-flex justify-content-center">
					<button type="submit" class="btn btn-success mx-3 px-5">Simpan</button>
					<button type="reset" class="btn btn-warning mx-3 px-5">Reset</button>
				</div>
			</form>
		</div>
	</div>
	
@endsection

@section('after-scripts')
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
			$('.produk').on('change',autoaddfoto);
		});
	</script>
@endsection