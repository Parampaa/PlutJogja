@push('custom-css')
  .modal-error {
    background-color: #e74c3c;
}
@endpush

<div id="error-dialog" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #e74c3c">
        <h5 class="modal-title">Error</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @if(Session::has('error'))
          {{ Session::get('error') }}
          @push('script')
          <script type="text/javascript">
            $('#error-dialog').modal('show');
          </script>
          @endpush
        @endif
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

