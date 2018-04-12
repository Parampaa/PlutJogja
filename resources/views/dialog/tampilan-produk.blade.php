<div id="tampilan-produk" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Produk Mitra</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-5">
          <p class="display-4"><% produkTampilan.namaBadan %></p>
          <div class="row text-muted">
            <div class="col-lg-3 col-4">Nama Pemilik</div>
            <div class="col-lg-9 col-8">: <% produkTampilan.namaPemilik %></div>
          </div>
          <div class="row text-muted">
            <div class="col-lg-3 col-4">ID Mitra</div>
            <div class="col-lg-9 col-8">: <% produkTampilan.id %></div>
          </div>
          <hr>
          <div class="row">
            <div class="col-lg-4 col-6" ng-repeat="i in produkTampilan.daftar_produk">
              <div class="card w-100">
                <img class="card-img-top" ng-src="<%i.image%>" src="/img/noimg.jpg" alt="<% i.nama %>">
                <div class="card-body">
                  <h5 class="card-title"><% i.nama %></h5>
                  <p class="card-text"><% i.jenis_usaha.nama %></p>
                </div>
                <div class="card-footer">
                  <button class="btn btn-warning" type="button" ng-click="windowProduk(2,i)">Edit</button>
                  <button class="btn btn-danger" type="button" ng-click="windowProduk(3,i)">Delete</button>
                </div>
              </div>
            </div>
          </div>
          <hr>
          <div ng-show="modeProduk == 1" id = 'form-tambah-produk' class="row d-flex justify-content-center text-white" style="background-color: #2d98da">
            <form enctype="multipart/form-data" action="" class="p-5">
              {{ csrf_field() }}
              <input type="hidden" name="idMitra" value="<% produkTampilan.id %>">
              <h5 class="text-center" style="">Tambah Produk</h5>
              <div class="form-group">
                <label>Nama Produk</label>
                <input type="text" name="nama" class="form-control">
              </div>
              <div class="form-group">
                <label>Jenis Produk</label>
                <select name="jenis" class="form-control">
                  @foreach($jenisUsaha as $list)
                  <option value="{{$list->id}}">{{ $list->nama }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>Foto Produk</label>
                <input type="file" name="image" class="form-control">
              </div>
              <div class="d-flex">
                <div class="mr-auto"></div>
                <button class="btn btn-success mr-1" type="button" ng-click="tambahProduk()">Simpan</button>
                <button class="btn btn-danger" type="reset">Cancel</button>
              </div>
              
            </form>
          </div>
          <div ng-show="modeProduk == 2" id = 'form-edit-produk' class="row d-flex justify-content-center text-white" style="background-color: #fdcb6e">
            <form enctype="multipart/form-data" action="" class="p-5">
              {{ csrf_field() }}
              <input type="hidden" name="id" value="<% selectedProduk.id %>">
              <h5 class="text-center" style="">Edit Produk</h5>
              <div class="form-group">
                <label>Nama Produk</label>
                <input type="text" name="nama" class="form-control" ng-value="selectedProduk.nama">
              </div>
              <div class="form-group">
                <label>Jenis Produk</label>
                <select name="jenis" class="form-control">
                  @foreach($jenisUsaha as $list)
                  <option value="{{$list->id}}" ng-selected="selectedProduk.jenis == {{$list->id}}">{{ $list->nama }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>Foto Produk</label>
                <div class="row">
                  <img ng-src="<%selectedProduk.image%>" src="/img/noimg.jpg" class="img-thumbnail mx-auto">
                </div>
                <input type="file" name="image" class="form-control">
              </div>
              <div class="d-flex">
                <div class="mr-auto"></div>
                <button class="btn btn-success mr-1" type="button" ng-click="editProduk()">Simpan</button>
                <button class="btn btn-danger" type="button" ng-click="cancelProduk()">Cancel</button>
              </div>
              
            </form>
          </div>
          <div ng-show="modeProduk == 3" id = 'form-hapus-produk' class="row d-flex justify-content-center text-white" style="background-color: #d63031">
            <form enctype="multipart/form-data" action="" class="p-5">
              {{ csrf_field() }}
              <input type="hidden" name="id" value="<% selectedProduk.id %>">
              <h5 class="text-center" style="">Hapus Produk</h5>
              <p>Apakah produk <u><% selectedProduk.nama %></u> akan dihapus dari Mitra ini?</p>
              <div class="d-flex">
                <button class="btn btn-success mr-1 ml-auto" type="button" ng-click="deleteProduk()">Simpan</button>
                <button class="btn btn-danger mr-auto" type="button" ng-click="cancelProduk()">Cancel</button>
              </div>
              
            </form>
          </div>
          <hr id="pembatasproduk">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>