<div class="form-group">
	<div class="border p-5">
		<label>Foto Produk <span class="count"></span></label>
		<input type="file" class="produk form-control-file" name="fproduk[]" accept="image/*" multiple>
		<div class="row">
			<div class="col-md-6 col-12 d-flex" ng-repeat="i in mitraProduk">
				<a class="p-2 align-self-center" href="#">
					<img class="img-fluid img-thumbnail" src="<% i.image %>">
				</a>
				<button class="btn btn-danger align-self-center" ng-click="mitra__image__delete(i.id)">Hapus</button>
			</div>	
		</div>
	</div>
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