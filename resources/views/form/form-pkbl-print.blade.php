@extends('layouts.appV1')

@section('custom-css')
	.data .row div:nth-child(2){
		font-weight:bold;
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
		<div class="data px-5">
			
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-4">Nama Usaha</div>
				<div class="col-md-4">{{ $nama_usaha }}</div>
			</div>
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-4">Jenis Usaha</div>
				<div class="col-md-4">{{ $jenis_usaha }}</div>
			</div>
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-4">Anggota Kelompok/Sentra</div>
				<div class="col-md-4">{{ $kelompok_usaha }}</div>
			</div>
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-4">Alamat Usaha</div>
				<div class="col-md-4">{{ $alamat_usaha }}</div>
			</div>
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-4">Nama Pemilik</div>
				<div class="col-md-4">{{ $nama_pemilik }}</div>
			</div>
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-4">Telpon / HP</div>
				<div class="col-md-4">{{ $telp }}</div>
			</div>
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-4">Tahun Berdiri</div>
				<div class="col-md-4">{{ $tahun }}</div>
			</div>
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-4">Modal Awal</div>
				<div class="col-md-4">{{ $modal }}</div>
			</div>
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-4">Total Asset</div>
				<div class="col-md-4">{{ $total_asset }}</div>
			</div>
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-4">Total Omset/Tahun</div>
				<div class="col-md-4">{{ $total_omset }}</div>
			</div>
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-4">Jumlah Karyawan</div>
				<div class="col-md-4">{{ $karyawan_laki }} (Laki-laki) {{ $karyawan_perempuan}} (Perempuan)</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					
				</div>
			</div>
		
		</div>
	</div>
	
@endsection
