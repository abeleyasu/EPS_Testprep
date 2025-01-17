<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width,initial-scale=1.0">

    <title>@yield('title', 'OneUI - Bootstrap 5 Admin Template &amp; UI Framework')</title>

    @include('layouts.meta')

    <!-- SEO Tags 
    <meta name="description" content="OneUI - Bootstrap 5 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
    <meta name="author" content="pixelcave">
    <meta name="robots" content="noindex, nofollow">

    Open Graph Meta
    <meta property="og:title" content="OneUI - Bootstrap 5 Admin Template &amp; UI Framework">
    <meta property="og:site_name" content="OneUI">
    <meta property="og:description" content="OneUI - Bootstrap 5 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    -->

    <!-- Icons -->
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <link rel="shortcut icon" href="{{asset('assets/media/favicons/favicon.png')}}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{asset('assets/media/favicons/favicon-192x192.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/media/favicons/apple-touch-icon-180x180.png')}}">
    <!-- END Icons -->

    <!-- Stylesheets -->
    <!-- Fonts and OneUI framework -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" id="css-main" href="{{asset('assets/css/oneui.min.css')}}">
    <link rel="stylesheet" id="css-main-custom" href="{{asset('assets/css/custom.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/select2/select2.min.css') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/css/intlTelInput.css">
    <style>
      .iti { width: 100%; }
    </style>
    <link rel="stylesheet" href="{{asset('assets/css/toastr/toastr.min.css')}}">

    <!-- You can include a specific file from css/themes/ folder to alter the default color theme of the template. eg: -->
    <!-- <link rel="stylesheet" id="css-theme" href="assets/css/themes/amethyst.min.css"> -->
    @yield('page-style')
    <!-- END Stylesheets -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

  </head>
  <body>

  @if(session()->has('success'))
    <div class="alert alert-primary alert-dismissible" role="alert">
      <p class="mb-0">
        {{ session('success') }}
      </p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif
  @if(session()->has('error'))
    <div class="alert alert-danger alert-dismissible" role="alert">
      <p class="mb-0">
        {{ session('error') }}
      </p>
    </div>
  @endif
    @yield('page-content')
    <input type="hidden" name="site_url" id="site_url" value="{{ \Illuminate\Support\Facades\URL::to('/'); }}">
    <!--
        OneUI JS

        Core libraries and functionality
        webpack is putting everything together at assets/_js/main/app.js
    -->
    <!-- jQuery (required for jQuery Validation plugin) -->
    <script src="{{asset('assets/js/lib/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/oneui.app.min.js')}}"></script>


    <!-- Page JS Plugins -->
    <script src="{{asset('assets/js/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
      <!-- calendar Plugin -->
	
	<script src="{{asset('assets/js/custom.js')}}"></script>
    <!-- Page JS Code -->
	<script>window.MathJax = { MathML: { extensions: ["mml3.js", "content-mathml.js"]}};</script>
  <script src="{{ asset('assets/js/select2/select2.min.js') }}"></script>
	<script type="text/javascript" async src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.0/MathJax.js?config=MML_HTMLorMML"></script>

  <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/intlTelInput.min.js"></script>

  <script>
    const input = document.querySelector("#phone");
    let intl = null
    let parent_phoneintl = null; 
    if (input) {
      intl = window.intlTelInput(input, {
        initialCountry: "us",
      });
    }

    $('#phone').on('change', function(e, countryData) {
      if (intl) {
        const countryData = intl.getSelectedCountryData();
        const number = '+' + countryData.dialCode + $(this).val();
        intl.setNumber(number);
      }
    });

    const parent_phone = document.querySelector('#parent_phone');
    if (parent_phone) {
      parent_phoneintl = window.intlTelInput(parent_phone, {
        initialCountry: "us",
      });
    }

    $('#parent_phone').on('change', function(e, countryData) {
      if (parent_phoneintl) {
        const countryData = parent_phoneintl.getSelectedCountryData();
        const number = '+' + countryData.dialCode + $(this).val();
        parent_phoneintl.setNumber(number);
      }
    });

    const constructMessage = (message, element_id, status) => {
      let element = '#' + element_id;
      $(element).html('')
      const alert = `
          <div class="alert alert-${status} alert-dismissible fade show" role="alert">
          ${message}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>`
      $(element).append(alert);
    }

    function resetEmailVerfication(id) {
      return $.ajax({
        url: "{{ route('verification.resend') }}",
        type: 'POST',
        data: {
          _token: "{{ csrf_token() }}",
          id: id,
        }
      })
    }

    $('#resend-verification-link').on('click', async function (e) {
      e.preventDefault();
      const response = await resetEmailVerfication($('#email-verification-id').val());
      if (response.success) {
        $('#verfication-emaiil-alerts').html('')
        constructMessage(response.message, 'verfication-emaiil-alerts', 'success')
      } else {
        $('#verfication-emaiil-alerts').html('')
        constructMessage(response.message, 'verfication-emaiil-alerts', 'danger')
      }
    })

    const ajax = (url, options = null) => {
      return {
        delay: 500,
        url: url,
        dataType: 'json',
        data: function (params) {
          var query = {
            search: params.term,
            page: params.page || 1
          }
          if (options) {
            query = {...query, ...options}
          }
          return query;
        },
        processResults: function (data, params) {
          params.page = params.page || 1;
          return {
            results: data.data,
            pagination: {
              more: (params.page * 30) < data.total
            }
          };
        }
      }
    }
  </script>

  
    @yield('page-script')
	<script>
	 $(document).ready(function(){
		 setTimeout(function(){ 
			 $('.videoResp .fullwidth_center iframe').width('100%');
			 $('.videoResp .fullwidth_center').css('text-align','center');
			 $('.videoResp .fullwidth_left iframe').width('100%');
			 $('.videoResp .fullwidth_left').css('text-align','left');
			 $('.videoResp .fullwidth_right iframe').width('100%');
			 $('.videoResp .fullwidth_right').css('text-align','right');
			 
			 $('.videoResp img').width('100%');
			 $('.videoResp img').width('100%');
			 $('.videoResp img').width('100%');
		 }, 1000);	 
	 });

	</script>

  </body>
</html>
