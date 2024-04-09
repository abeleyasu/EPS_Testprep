<div class="modal fade" id="email-verification-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="email-verification-label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #f6f7f9">
        <h5 class="modal-title text-dark" id="email-verification-label">Verify Your Email Address</h5>
        {{--- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
      </div>
      <div class="modal-body p-sm-3">
        <div id="verfication-emaiil-alerts"></div>
        <p class="fw-medium text-muted mb-1">
            {{ __('Before proceeding, please check your email for a verification link.') }}
        </p>
        <p class="fw-medium text-muted">{{ __('If you did not receive the email') }},</p>
        <input type="hidden" name="id" id="email-verification-id">
        <button type="button" id="resend-verification-link" class="btn w-100 btn-alt-success">{{ __('Click here to request another') }}</button>
      </div>
    </div>
  </div>
</div>