<div>
    <a  class="btn btn-alt-danger reset-draft" onclick="Reset_drafts()"
        name="reset_drafts" id="reset_drafts" style="pointer-events:{{ !empty($details) ? 'none' : 'unset' }};opacity:{{ !empty($details) ? '0.6' : '1' }}">
    
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
        </svg>
        Reset all drafts
    </a>
        
</div>

<script src="{{asset('assets/js/sweetalert2/sweetalert2.all.min.js')}}"></script>
<link rel="stylesheet" href="{{asset('assets/css/toastr/toastr.min.css')}}">
<script src="{{asset('assets/js/toastr/toastr.min.js')}}"></script>


<script>
    
    function Reset_drafts() {
        Swal.fire({
                title: 'Are you sure to reset all drafts?',
                text: "You won't be able to delete this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
        })  
        .then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `{{ route('admin-dashboard.highSchoolResume.discarddrafts') }}`,
                    type: 'GET',
                    success:function(response) {
                        window.location.href = "{{ route('admin-dashboard.highSchoolResume.personalInfo')}}";
                    }
                });
            }   
        });
    }

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
            "extendedTimeOut": "10000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
  </script>
