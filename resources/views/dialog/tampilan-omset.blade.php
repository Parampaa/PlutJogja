<div id="tampilan-omset" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Omset Mitra</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-5">
          <p class="display-4"><% omsetTampilan.namaBadan %></p>
          <div class="row text-muted">
            <div class="col-lg-3 col-4">Nama Pemilik</div>
            <div class="col-lg-9 col-8">: <% omsetTampilan.namaPemilik %></div>
          </div>
          <div class="row text-muted">
            <div class="col-lg-3 col-4">ID Mitra</div>
            <div class="col-lg-9 col-8">: <% omsetTampilan.id %></div>
          </div>
          <hr>
          <table class="table table-striped">
            <thead>
              <tr>
                <td>No</td>
                <td>Waktu</td>
                <td>Omset</td>
                <td>Aksi</td>
              </tr>
            </thead>
            <tbody>
              <tr ng-repeat="i in omsetTampilan.dataomset track by $index">
                <td><% $index+1 %></td>
                <td><% i.created_at %></td>
                <td><% i.omset %></td>
                <td>
                  <button class="btn btn-warning" type="button" ng-click="windowomset(2,i)">Edit</button>
                  <button class="btn btn-danger" type="button" ng-click="windowomset(3,i)">Delete</button>
                </td>
              </tr>  
            </tbody>
            
          </table>
          
          <hr>
          <div ng-show="modeomset == 1" id = 'form-tambah-omset' class="row d-flex justify-content-center text-white" style="background-color: #2d98da">
            <form enctype="multipart/form-data" class="w-100 p-5">
              {{ csrf_field() }}
              <input type="hidden" name="idMitra" value="<% omsetTampilan.id %>">
              <h5 class="text-center" style="">Tambah omset</h5>
              <div class="form-group">
                <label>Waktu</label>
                <input type="date" name="time" class="form-control">
              </div>
              <div class="form-group">
                <label>Omset</label>
                <input type="number" name="omset" class="form-control">
              </div>
              <div class="d-flex">
                <div class="mr-auto"></div>
                <button class="btn btn-success mr-1" type="button" ng-click="mitra__omset_tambah()">Simpan</button>
                <button class="btn btn-danger" type="reset">Cancel</button>
              </div>
              
            </form>
          </div>
          <div ng-show="modeomset == 2" id = 'form-edit-omset' class="row d-flex justify-content-center text-white" style="background-color: #fdcb6e">
            <form enctype="multipart/form-data" action="" class="p-5">
              {{ csrf_field() }}
              <input type="hidden" name="idMitra" value="<% omsetTampilan.id %>">
              <input type="hidden" name="id" value="<% selectedomset.id %>">
              <h5 class="text-center" style="">Edit omset</h5>
              <div class="form-group">
                <label>Waktu</label>
                <input type="date" name="time" class="form-control" ng-value="selectedomset.time">
              </div>
              <div class="form-group">
                <label>Omset</label>
                <input type="number" name="omset" class="form-control" ng-value="selectedomset.omset">
              </div>
              <div class="d-flex">
                <div class="mr-auto"></div>
                <button class="btn btn-success mr-1" type="button" ng-click="mitra__omset_edit()">Simpan</button>
                <button class="btn btn-danger" type="reset" ng-click="cancelomset()">Cancel</button>
              </div>

             
              
            </form>
          </div>
          <div ng-show="modeomset == 3" id = 'form-hapus-omset' class="row d-flex justify-content-center text-white" style="background-color: #d63031">
            <form enctype="multipart/form-data" action="" class="p-5">
              {{ csrf_field() }}
              <input type="hidden" name="id" value="<% selectedomset.id %>">
              <h5 class="text-center" style="">Hapus omset</h5>
              <p>Apakah omset <u><% selectedomset.nama %></u> akan dihapus dari Mitra ini?</p>
              <div class="d-flex">
                <button class="btn btn-success mr-1 ml-auto" type="button" ng-click="mitra__omset_delete()">Simpan</button>
                <button class="btn btn-danger mr-auto" type="button" ng-click="cancelomset()">Cancel</button>
              </div>
              
            </form>
          </div>
          <hr id="pembatasomset">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>