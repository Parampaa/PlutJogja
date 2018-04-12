<div id="form-pencarian" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Pencarian Mitra</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="checkbox" ng-model="mitra__field_search['id']" class="form-control" ng-change="mitra__field_check('id')"> ID Mitra
        <input type="checkbox" ng-model="mitra__field_search['namaPemilik']" ng-change="mitra__field_check('namaPemilik')" class="form-control"> Nama Pemilik
        <input type="checkbox" ng-model="mitra__field_search['namaBadan']" ng-change="mitra__field_check('namaBadan')" class="form-control"> Nama Usaha
        <input type="checkbox" ng-model="mitra__field_search['alamat']" ng-change="mitra__field_check('alamat')" class="form-control"> Alamat
        <input type="checkbox" ng-model="mitra__field_search['kontak']" ng-change="mitra__field_check('kontak')" class="form-control"> Kontak
        <input type="checkbox" ng-model="mitra__field_search['email']" ng-change="mitra__field_check('email')" class="form-control"> Email
        <input type="checkbox" ng-model="mitra__field_search['npwp']" ng-change="mitra__field_check('npwp')" class="form-control"> NPWP
        <input type="checkbox" ng-model="mitra__field_search['website']" ng-change="mitra__field_check('website')" class="form-control"> Website
        <input type="checkbox" ng-model="mitra__field_search['sentra']" ng-change="mitra__field_check('sentra')" class="form-control"> Sentra
        <input type="text" class="form-control" name="keyword" ng-model="mitra__keyword">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" ng-click="mitra__search()" data-dismiss="modal">Cari</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>