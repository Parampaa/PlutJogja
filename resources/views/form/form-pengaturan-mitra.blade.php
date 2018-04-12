<ul class="nav nav-tabs" id="tab-pengaturan" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="tampilan_tab-tab" data-toggle="tab" href="#tampilan_tab" role="tab" aria-controls="tampilan_tab" aria-selected="true">Tampilan</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="kriteria_tab-tab" data-toggle="tab" href="#kriteria_tab" role="tab" aria-controls="kriteria_tab" aria-selected="false">Kriteria UMKM</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="jenis_umkm_tab-tab" data-toggle="tab" href="#jenis_umkm_tab" role="tab" aria-controls="jenis_umkm_tab" aria-selected="false">Jenis UMKM</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="legalitas_tab-tab" data-toggle="tab" href="#legalitas_tab" role="tab" aria-controls="legalitas_tab" aria-selected="false">Legalitas UMKM</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="export_tab-tab" data-toggle="tab" href="#export_tab" role="tab" aria-controls="export_tab" aria-selected="false">Export Excel</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="import_tab-tab" data-toggle="tab" href="#import_tab" role="tab" aria-controls="import_tab" aria-selected="false">Import Excel</a>
  </li>
</ul>
<div class="tab-content" id="tab-pengaturan-menu">
  <div class="tab-pane fade show active p-5" id="tampilan_tab" role="tabpanel" aria-labelledby="tampilan_tab-tab">
  	<h3>Tampilan Kolom dari Tabel Mitra PLUT UMKM</h3>
  <form>
  	<div class="form-check">
  		<input type="checkbox" ng-model="table_id">
		<label class="form-check-label">
    		ID Mitra
  		</label>
  	</div>
  	<div class="form-check">
  		<input type="checkbox" ng-model="table_namaPemilik">
  		<label class="form-check-label">
  			Nama Pemilik
  		</label>
  	</div>
  	<div class="form-check">
  		<input type="checkbox" ng-model="table_namaBadan">
  		<label class="form-check-label">
  			Nama Badan
  		</label>
  	</div>
  	<div class="form-check">
  		<input type="checkbox" ng-model="table_jenis_usaha">
  		<label class="form-check-label">
  			Jenis Usaha
  		</label>
  	</div>
  	<div class="form-check">
  		<input type="checkbox" ng-model="table_kecamatan">
  		<label class="form-check-label">
  			Kecamatan
  		</label>
  	</div>
  	<div class="form-check">
  		<input type="checkbox" ng-model="table_kabupaten">
  		<label class="form-check-label">
  			Kabupaten
  		</label>
  	</div>
  	<div class="form-check">
  		<input type="checkbox" ng-model="table_kontak">
  		<label class="form-check-label">
  			Kontak
  		</label>
  	</div>
  	<div class="form-check">
  		<input type="checkbox" ng-model="table_status">
  		<label class="form-check-label">
  			Status Usaha
  		</label>
  	</div>
  	<div class="form-check">
  		<input type="checkbox" ng-model="table_email">
  		<label class="form-check-label">
  			Email
  		</label>
  	</div>
  	<div class="form-check">
  		<input type="checkbox" ng-model="table_website">
  		<label class="form-check-label">
  			Website
  		</label>
  	</div>
  	<div class="form-check">
  		<input type="checkbox" ng-model="table_npwp">
  		<label class="form-check-label">
  			NPWP
  		</label>
  	</div>
  	<div class="form-check">
  		<input type="checkbox" ng-model="table_legalitas">
  		<label class="form-check-label">
  			Legalitas
  		</label>
  	</div>
  	<div class="form-check">
  		<input type="checkbox" ng-model="table_sentra">
  		<label class="form-check-label">
  			Sentra
  		</label>
  	</div>
  	<div class="form-check">
  		<input type="checkbox" ng-model="table_modal">
  		<label class="form-check-label">
  			Modal
  		</label>
  	</div>
  	<div class="form-check">
  		<input type="checkbox" ng-model="table_omset">
  		<label class="form-check-label">
  			Omset
  		</label>
  	</div>
  	<div class="form-check">
  		<input type="checkbox" ng-model="table_asset">
  		<label class="form-check-label">
  			Asset
  		</label>
  	</div>
  	<div class="form-check">
  		<input type="checkbox" ng-model="table_volume">
  		<label class="form-check-label">
  			Volume
  		</label>
  	</div>
  	<div class="form-check">
  		<input type="checkbox" ng-model="table_kriteria">
  		<label class="form-check-label">
  			Kriteria UMKM
  		</label>
  	</div>
  	<div class="form-check">
  		<input type="checkbox" ng-model="table_karyawan">
  		<label class="form-check-label">
  			Karyawan
  		</label>
  	</div>
    <button class="btn btn-warning my-2" type="button" ng-click="setTampilan(1)">Toggle</button>
  </form>
  	<button class="btn btn-success" type="button" ng-click="setTampilan()">Simpan</button>
  </div>
  <div class="tab-pane fade" id="kriteria_tab" role="tabpanel" aria-labelledby="kriteria_tab-tab">
  	<form method="post" action="{{route('kriteria-set')}}" class="p-5">
  		{{csrf_field()}}
  		<div ng-repeat="i in kriteria track by $index">
	  		<div class="row">
	  			<h3 class="display-5">Kriteria <% $index+1 %></h3>
	  		</div>
	  		<div class="row">
	  			<input type="hidden" name="id_kriteria[]" value="<% i.id %>">
	  			<div class="col-3">
	  				<div class="form-group">
	  					<label>Nama Kriteria</label>
	  				</div>
	  			</div>
	  			<div class="col-9">
	  				<div class="form-group">
	  					<input type="text" name="nama_kriteria[]" value="<% i.label %>" class="form-control"  >
	  				</div>
	  			</div>
	  		</div>
	  		<div class="row">
	  			<div class="col-3">
	  				<div class="form-group">
	  					<label>Batas Asset</label>
	  				</div>
	  			</div>
	  			<div class="col-9">
	  				<div class="form-group">
	  					<input type="number" name="asset_kriteria[]" value="<% i.batas_asset %>" class="form-control">
	  				</div>
	  			</div>
	  		</div>
	  		<div class="row">
	  			<div class="col-3">
	  				<div class="form-group">
	  					<label>Batas Omset</label>
	  				</div>
	  			</div>
	  			<div class="col-9">
	  				<div class="form-group">
	  					<input type="number" name="omset_kriteria[]" value="<% i.batas_omset %>" class="form-control">
	  				</div>
	  			</div>
	  		</div>
  		</div>
  		<button type="button" class="btn btn-success" ng-click="tambahKriteria()">Tambah Kriteria</button>
  		<button class="btn btn-primary" ng-show="kriteria.length">Simpan</button>
  	</form>
  </div>
  <div class="tab-pane fade p-5" id="jenis_umkm_tab" role="tabpanel" aria-labelledby="jenis_umkm_tab-tab">
    <form action="{{route('jenis_umkm')}}" method="post">
        {{ csrf_field() }}
        <h5>Jenis Usaha di UMKM</h5>
        @foreach($jenisUsaha as $list)
        <div class="form-group template_jenis_umkm">
            <label style="background-color: #f96; color: white" class="p-1">Jenis Usaha {{$loop->index+1}}</label>
            <input type="hidden" name="id[]" value="{{$list->id}}" class="form-control">
            <div class="row">
              <div class="col-2">Nama</div>
              <div class="col-10"><input type="text" name="nama[]" value="{{$list->nama}}" class="form-control"></div>
            </div>
            <div class="row">
              <div class="col-2">Deskripsi</div>
              <div class="col-10"><textarea name="deskripsi[]" class="form-control">{{ $list->deskripsi}}</textarea></div>
            </div>
        </div>
        @endforeach
        <button type="button" class="btn btn-warning" ng-click="tambahJenis()">Tambah</button>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
  </div>
  <div class="tab-pane fade p-5" id="legalitas_tab" role="tabpanel" aria-labelledby="legalitas_tab-tab">
    <form action="{{route('legalitas')}}" method="post">
        {{ csrf_field() }}
        <h5>Jenis Legalitas Usaha di UMKM</h5>
        @foreach($legalitas as $list)
        <div class="form-group template_legalitas_umkm">
            <label style="background-color: #f96; color: white" class="p-1">Jenis Legalitas {{$loop->index+1}}</label>
            <input type="hidden" name="id[]" value="{{$list->id}}" class="form-control">
            <div class="row">
              <div class="col-2">Nama</div>
              <div class="col-10"><input type="text" name="nama[]" value="{{$list->nama}}" class="form-control"></div>
            </div>
            <div class="row">
              <div class="col-2">Deskripsi</div>
              <div class="col-10"><textarea name="deskripsi[]" class="form-control">{{ $list->deskripsi}}</textarea></div>
            </div>
        </div>
        @endforeach
        <button type="button" class="btn btn-warning" ng-click="tambahLegalitas()">Tambah</button>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
  </div>
  <div class="tab-pane fade p-5" id="export_tab" role="tabpanel" aria-labelledby="export_tab-tab">
    <form>
        <div class="form-group">
            <label>Nama Dokumen</label>
            <input type="text" name="sheet" class="form-control" ng-model="exportName">
        </div>
        <div class="form-group">
            <label>Mode</label>
            <select class="form-control" name="mode" ng-model="exportMode">
              <option value="now">Tampilan Sekarang</option>
              <option value="all">Seluruh data</option>
            </select>
        </div>
        <button type="button" class="btn btn-success" ng-click="export()">Download</button>
    </form>
  </div>
  <div class="tab-pane fade p-5" id="import_tab" role="tabpanel" aria-labelledby="import_tab-tab">
    <form action="{{route('mitra-import')}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
            <label>Nama Sheet</label>
            <input type="text" name="sheet" class="form-control">
        </div>
        <div class="form-group">
            <label>Baris Awal</label>
            <input type="number" name="baris_awal" class="form-control">
        </div>
        <div class="form-group">
            <label>Baris Akhir</label>
            <input type="number" name="baris_akhir" class="form-control">
        </div>
        <div class="form-group">
            <label>File XLSX</label>
            <input type="file" name="excel" class="form-control">
        </div>
        <div class="form-group">
            <label>Mode</label>
            <select class="form-control" name="mode">
              <option value="replace">Mode Timpa</option>
              <option value="update">Mode Update</option>
              <option value="add">Mode Tambah</option>
            </select>
        </div>
        <button class="btn btn-dark" type="submit">Import</button>
    </form>
  </div>
</div>