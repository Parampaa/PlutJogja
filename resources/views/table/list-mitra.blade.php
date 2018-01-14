<table id="data-mitra" class="table table-responsive py-3">
	<thead>
		<tr>
			<td>No Mitra</td>
			<td>Nama Pemilik</td>
			<td>Nama Usaha</td>
			<td>Jenis Usaha</td>
			<td>Kecamatan</td>
			<td>Kabupaten</td>
			<td>Produk</td>
			<td>Aksi</td>
		</tr>
	</thead>
	<tbody>
		<tr ng-repeat="mitra in data">
			<td><% mitra.id %></td>
			<td><% mitra.namaPemilik %></td>
			<td><% mitra.namaBadan %></td>
			<td><% mitra.jenis_usaha.nama %></td>
			<td><% mitra.asal_kecamatan.kecamatan %></td>
			<td><% mitra.asal_kabupaten.nama %></td>
			<td>
				<a class="btn btn-primary" href="">Lihat Produk</a>
			</td>
			<td>
				<a class="btn btn-warning" href="" ng-click="mitra__edit(mitra.id)" data-target="#form-edit" data-toggle="modal">Edit</a>
				<a class="btn btn-danger" href="" ng-click="mitra__delete(mitra.id)">Hapus</a>
			</td>
		</tr>
	</tbody>
</table>