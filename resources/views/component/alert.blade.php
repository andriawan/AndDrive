@if (session('status') != null)
  <div class="alert alert-success alert-dismissible fade show" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      <h4 class="alert-heading">Done!</h4>
      <p>{{ session('status') }}</p>
      <hr>
      <p class="mb-0">AndDrive versi Beta</p>
  </div>
@endif