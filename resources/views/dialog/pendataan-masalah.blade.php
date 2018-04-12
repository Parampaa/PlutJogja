<div id="form-pendataan-masalah" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Pendataan Masalah</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @include('form.form-pendataan-masalah')
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" ng-click="btn__save('#form-pendataan-masalah','{{route('konsultasi-add')}}')">Simpan</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>