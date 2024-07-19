
@if (session()->has('success'))

  <script>
    document.addEventListener('DOMContentLoaded', function() {
        var myToast = new bootstrap.Toast(document.getElementById('success'));
        myToast.show();
    });
  </script>
  <div class="position-fixed bottom-0 end-0 mt-5 me-5 mb-5" style="z-index: 9999;">
    <div class="toast bg-primary show" id="error" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header bg-primary py-3">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill fs-2 text-white me-3" viewBox="0 0 16 16">
          <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
        </svg>
        <strong class="me-auto text-white fs-7">Success</strong>
        <small class="text-white">Now</small>
        <button type="button" class="btn-close p-2 bg-white" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body text-white py-3">
        {{ session('success') }}
      </div>
    </div>
  </div>

@elseif (session()->has('error'))

  <script>
    document.addEventListener('DOMContentLoaded', function() {
        var myToast = new bootstrap.Toast(document.getElementById('error'));
        myToast.show();
    });
  </script>
  <div class="position-fixed bottom-0 end-0 mt-5 me-5 mb-5" style="z-index: 9999;">
    <div class="toast bg-danger show" id="error" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header bg-danger py-3">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle-fill fs-2 text-white me-3" viewBox="0 0 16 16">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
          </svg>
          <strong class="me-auto text-white fs-7">Failed</strong>
          <small class="text-white">Now</small>
          <button type="button" class="btn-close p-2 bg-white" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body text-white py-5">
        {{ session('error') }}
      </div>
    </div>
  </div>

@endif

<script type="text/javascript">
  document.addEventListener('DOMContentLoaded', function() {
    document.body.addEventListener('click', function(event) {
      if (event.target.classList.contains('btn-del')) {
        var link = event.target.id;
        var myModal = new bootstrap.Modal(document.getElementById('delete'));
        myModal.show();
        document.querySelector('.btn-delete-oke').addEventListener('click', function() {
          window.location.replace(link);
        });
      }
    });
  });
</script>

<div class="modal modal-delete" id="delete" data-bs-backdrop="static">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <div class="modal-content shadow rounded ">
      <div class="modal-body p-4 text-center py-8">
        <h5 class="mb-2">Confirmation</h5>
        <p class="mb-0">Are you sure you want to delete this data?</p>
      </div>
      <div class="modal-footer flex-nowrap p-0">
        <button type="button" class="btn-delete-oke btn btn-lg btn-secondary bg-transparent text-dark fs-6 text-decoration-none col-6 m-0 rounded-0 border-end" >Delete</button>
        <button type="button" class="btn btn-lg btn-secondary bg-transparent text-dark fs-6 text-decoration-none col-6 m-0 rounded-0" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
      </div>
    </div>
  </div>
</div>