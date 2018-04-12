<div id="form-penghapusan" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Konfirmasi Penghapusan Mitra</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Apakah Anda yakin akan menghapus data mitra dengan id mitra <% conf_del_mitra.id %> ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" ng-click="mitra__delete()" data-dismiss="modal">Hapus</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>