@extends('layouts.user')

@section('title', 'Rewards : CPS')

@section('user-content')
<main id="main-container">
  <div class="content">
    <div class="text-center mb-3">
      <h1 class="h2 mb-0">Invite Student Now</h1>
      <span clas="h3 mb-0">Get Rewarded for bringing student</span>
    </div>
    <div class="block">
      <div class="block-content pb-3">
        <div class="d-flex align-items-center justify-content-center text-center row">
          <div class="col-12 col-md-6">
            <div class="d-flex gap-2 flex-column align-items-center justify-content-center">
              <div class="fs-4 fw-bold">Your Points</div>
              <div class="input-group">
                <div id="total" class="form-control">{{ auth()->user()->referred_rewards_points }}</div>
                <button type="button" class="btn btn-primary"  @disabled(auth()->user()->referred_rewards_points == 0)>Redeem Credit</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="block">
      <div class="block-content pb-3">
        <div class="d-flex align-items-center justify-content-center text-center row">
          <div class="col-12 col-md-6">
            <div class="d-flex gap-4 flex-column align-items-center justify-content-center">
              <div class="d-flex gap-2 flex-column align-items-center justify-content-center">
                <div class="fs-4 fw-bold">Shared with Your Network</div>
                <div>
                  Copy the code or post directly to your social media pages.
                </div>
                <div class="input-group">
                  <div id="link" class="form-control">{{ route('get-code', [ 'code' => auth()->user()->referral_code]) }}</div>
                  <button type="button" id="copy-link" class="btn btn-primary">Copy Link</button>
                </div>
                <div class="input-group">
                  <div id="code" class="form-control">{{ auth()->user()->referral_code }}</div>
                  <button type="button" id="copy-code" class="btn btn-primary">Copy Code</button>
                </div>
              </div>
              <div class="d-flex gap-3 align-items-center justify-content-center">
                @include('user.rewards.icons.icon', ['icon' => 'facebook'])
                @include('user.rewards.icons.icon', ['icon' => 'twitter'])
                @include('user.rewards.icons.icon', ['icon' => 'google'])
                @include('user.rewards.icons.icon', ['icon' => 'linkedin'])
                @include('user.rewards.icons.icon', ['icon' => 'tiktok'])
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="block">
      <div class="block-content pb-3">
        <div class="d-flex align-items-center justify-content-center text-center row">
          <div class="col-12 col-md-6">
            <div class="d-flex gap-4 flex-column align-items-center justify-content-center">
              <div class="d-flex gap-2 flex-column align-items-center justify-content-center">
                <div class="fs-4 fw-bold">Invite By Text</div>
                <div>
                  Confirm your phone number and we'll send your unique code directly to <br>
                  your mobile phone. Forward the text you receive to students.
                </div>
                <div class="mt-2">
                  <form id="phone-form">
                    <div class="d-flex flex-column gap-2 align-items-center justify-content-center">
                      <input type="text" name="phone" id="phone" class="form-control">
                      <button type="submit" class="btn btn-primary">Send</button>
                    </div>
                  </form>
                </div>
              </div>
              <div>
                Or
              </div>
              <div class="d-flex gap-2 flex-column align-items-center justify-content-center">
                <div class="fs-4 fw-bold">Invite By Email</div>
                <div>Type in email addresses.</div>
                <div>We won't store your contacts.</div>
                <div class="mt-2">
                  <form id="emails-form">
                    <div class="d-flex flex-column gap-2 align-items-center justify-content-center">
                      <textarea name="emails" id="emails" cols="30" rows="5" class="form-control" placeholder="Separate email address with commas."></textarea>
                      <button type="submit" class="btn btn-primary">Send Invite</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection

@section('page-style')
<link rel="stylesheet" href="{{asset('assets/css/toastr/toastr.min.css')}}">
<style>
  svg {
    cursor: pointer;
  }
</style>
@endsection

@section('user-script')
<script src="{{asset('assets/js/toastr/toastr.min.js')}}"></script>
<script>
  toastr.options = {
    "closeButton": true,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  }

  function sendNotification(type, data) {
    return $.ajax({
      url: "{{ route('rewards.send-notification') }}",
      method: 'POST',
      data: {
        type: type,
        ...data
      },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    }) 
  }

  $(document).ready(function () {

    $('.media-link').on('click', function (e) {
      const popupwindowsize = {
        width: 700,
        height: 600
      };

      const url = $(this).attr('href');
      if (!url)
      if (!url || url == '#') return;
      const domain = url.split('/')[2];
      const left = (screen.width - popupwindowsize.width) / 2;
      const top = (screen.height - popupwindowsize.height) / 2;
      let params = 'width=' + popupwindowsize.width + ', height=' + popupwindowsize.height;
      params += ', top=' + top + ', left=' + left;
      params += ', directories=no';
      params += ', location=no';
      params += ', menubar=no';
      params += ', resizable=no';
      params += ', scrollbars=no';
      params += ', status=no';
      params += ', toolbar=no';

      const popup = window.open(url, domain, params);
      if (window.focus) {
        popup.focus();
        e.preventDefault();
      }
    })

    $('#copy-code').on('click', function (e) {
      e.preventDefault();
      navigator.clipboard
      .writeText($('#code').text())
      .then(() => {
        toastr.success('Code copied successfully')
      })
      .catch((err) => {
        toastr.error('Failed to copy code')
      });
    })

    $('#copy-link').on('click', function (e) {
      e.preventDefault();
      navigator.clipboard
      .writeText("{{ route('get-code', [ 'code' => auth()->user()->referral_code]) }}")
      .then(() => {
        toastr.success('Link copied successfully')
      })
      .catch((err) => {
        toastr.error('Failed to copy code')
      });
    })

    const error_object = {
      errorPlacement: function(error, element) {},
      highlight: function(element, errorClass, validClass) {
        if (errorClass) {
          $(element).closest('.form-control').addClass("is-invalid");
        } else {
          $(element).removeClass("is-valid");
        }
      },
      unhighlight: function(element, errorClass, validClass) {
        if (validClass) {
          $(element).closest('.form-control').removeClass("is-invalid");
        } else {
          $(element).removeClass("is-invalid");
        }
      },
    }
    $('#phone-form').validate({
      rules: {
        phone: {
          required: true
        },
      },
      ...error_object
    })

    $('#emails-form').validate({
      rules: {
        emails: {
          required: true
        },
      },
      ...error_object
    })

    $('#phone-form').on('submit', async function (e) {
      e.preventDefault()
      if ($(this).valid()) {
        const response = await sendNotification('phone', {
          phone: $('#phone').val(),
        });
        if (response.success) {
          $('#phone-form').trigger('reset')
          toastr.success(response.message)
        } else {
          toastr.error(response.message)
        }
      }
    })

    $('#emails-form').on('submit', async function (e) {
      e.preventDefault()
      if ($(this).valid()) {
        const response = await sendNotification('email', {
          emails: $('#emails').val(),
        })
        if (response.success) {
          $('#emails-form').trigger('reset')
          toastr.success(response.message)
        } else {
          toastr.error(response.message)
        }
      }
    })
  })
  
</script>
@endsection
