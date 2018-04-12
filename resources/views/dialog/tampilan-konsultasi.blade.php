<div id="tampilan-konsultasi" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Konsultasi Mitra</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-5">
          <p class="display-4"><% konsultasiTampilan.namaBadan %></p>
          <div class="row text-muted">
            <div class="col-lg-3 col-4">Nama Pemilik</div>
            <div class="col-lg-9 col-8">: <% konsultasiTampilan.namaPemilik %></div>
          </div>
          <div class="row text-muted">
            <div class="col-lg-3 col-4">ID Mitra</div>
            <div class="col-lg-9 col-8">: <% konsultasiTampilan.id %></div>
          </div>
          <hr>
          <div class="row py-3" ng-repeat="i in konsultasiTampilan.datakonsul">
            <div class="col-12">
              <div class="card w-100">
                <div class="card-header">
                  Waktu: <% i.created_at %>
                </div>
                <div class="card-body">
                  <h5 class="card-title">Permasalahan</h5>
                  <p class="card-text"><% i.masalah %></p>
                  <h5 class="card-title">Diagnosa</h5>
                  <p class="card-text"><% i.diagnosa %></p>
                  <h5 class="card-title">Solusi</h5>
                  <p class="card-text"><% i.solusi %></p>
                </div>
                <div class="card-footer">
                  <button class="btn btn-warning" type="button" ng-click="windowkonsultasi(2,i)">Edit</button>
                  <button class="btn btn-danger" type="button" ng-click="windowkonsultasi(3,i)">Delete</button>
                </div>
              </div>
            </div>
            
            <!-- <div class="col-3" ng-repeat="i in konsultasiTampilan.daftar_konsultasi">
              <img class="img-thumbnail" src="<% i.image || '/img/noimg.jpg' %>">
              <p>
                <% i.nama %> [<b><% i.jenis_usaha.nama %></b>]
              </p>
            </div> -->
          </div>
          <hr>
          <div ng-show="modekonsultasi == 1" id = 'form-tambah-konsultasi' class="row d-flex justify-content-center text-white" style="background-color: #2d98da">
            <form enctype="multipart/form-data" class="w-100 p-5">
              {{ csrf_field() }}
              <input type="hidden" name="idMitra" value="<% konsultasiTampilan.id %>">
              <h5 class="text-center" style="">Tambah konsultasi</h5>
              <div class="form-group">
                <label>Permasalahan</label>
                <input type="text" name="masalah" class="form-control">
              </div>
              <div class="form-group">
                <label>Diagnosa</label>
                <textarea name="diagnosa" class="form-control form-control-lg"></textarea>
              </div>
              <div class="form-group">
                <label>Solusi</label>
                <textarea name="solusi" class="form-control form-control-lg"></textarea>
              </div>
              <div class="d-flex">
                <div class="mr-auto"></div>
                <button class="btn btn-success mr-1" type="button" ng-click="mitra__konsultasi_tambah()">Simpan</button>
                <button class="btn btn-danger" type="reset">Cancel</button>
              </div>
              
            </form>
          </div>
          <div ng-show="modekonsultasi == 2" id = 'form-edit-konsultasi' class="row d-flex justify-content-center text-white" style="background-color: #fdcb6e">
            <form enctype="multipart/form-data" action="" class="p-5">
              {{ csrf_field() }}
              <input type="hidden" name="idMitra" value="<% konsultasiTampilan.id %>">
              <input type="hidden" name="id" value="<% selectedkonsultasi.id %>">
              <h5 class="text-center" style="">Edit Konsultasi</h5>
              <div class="form-group">
                <label>Permasalahan</label>
                <input type="text" name="masalah" class="form-control" ng-value="selectedkonsultasi.masalah">
              </div>
              <div class="form-group">
                <label>Diagnosa</label>
                <textarea name="diagnosa" class="form-control form-control-lg"><%selectedkonsultasi.diagnosa%></textarea>
              </div>
              <div class="form-group">
                <label>Solusi</label>
                <textarea name="solusi" class="form-control form-control-lg"><%selectedkonsultasi.solusi%></textarea>
              </div>
              <div class="d-flex">
                <div class="mr-auto"></div>
                <button class="btn btn-success mr-1" type="button" ng-click="mitra__konsultasi_edit()">Simpan</button>
                <button class="btn btn-danger" type="reset" ng-click="cancelkonsultasi()">Cancel</button>
              </div>

             
              
            </form>
          </div>
          <div ng-show="modekonsultasi == 3" id = 'form-hapus-konsultasi' class="row d-flex justify-content-center text-white" style="background-color: #d63031">
            <form enctype="multipart/form-data" action="" class="p-5">
              {{ csrf_field() }}
              <input type="hidden" name="id" value="<% selectedkonsultasi.id %>">
              <h5 class="text-center" style="">Hapus konsultasi</h5>
              <p>Apakah konsultasi <u><% selectedkonsultasi.nama %></u> akan dihapus dari Mitra ini?</p>
              <div class="d-flex">
                <button class="btn btn-success mr-1 ml-auto" type="button" ng-click="mitra__konsultasi_delete()">Simpan</button>
                <button class="btn btn-danger mr-auto" type="button" ng-click="cancelkonsultasi()">Cancel</button>
              </div>
              
            </form>
          </div>
          <hr id="pembataskonsultasi">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>