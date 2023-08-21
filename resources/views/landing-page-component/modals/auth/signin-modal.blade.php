<div class="modal fade" id="sign-in-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="sign-in-label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #f6f7f9">
        <h5 class="modal-title text-dark" id="sign-in-label">Sign In</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-sm-3">
        <h1 class="h2 mb-1 text-dark">{{ config('app.app_name') }}</h1>
        <p class="fw-medium text-dark">
          Welcome, please login.
        </p>
        <div id="errors"></div>
        @include('components.auth.signin', [
          'sign_btn_hide' => false  
        ])
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" id="signin" class="btn btn-primary">Sign In</button>
      </div>
    </div>
  </div>
</div>