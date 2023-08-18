@extends('layouts.main')

@section('page-content')
<div id="page-container" class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed">
    @include('components.admin-nav')
    @include('components.admin-header')
	<style>
		.wrs_tickContainer {
			display: none !important;
		}
	</style>
    @yield('admin-content')

    @include('components.admin-footer')
</div>
<!-- END Page Container -->
@endsection

@section('page-script')

    <script src="{{asset('assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/datatables-responsive-bs5/js/responsive.bootstrap5.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/datatables-buttons/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/datatables-buttons-bs5/js/buttons.bootstrap5.min.js')}}"></script>
    <script src="{{asset('assets/js/pages/be_tables_datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/toastr/toastr.min.js')}}"></script>
    <script src="{{ asset('assets/js/sweetalert2/sweetalert2.all.min.js') }}"></script>

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

        function deleteItem(id) {
            if(confirm("Are you sure to delete this item?") == true) {
                $('#delete-form-'+id).submit();
            }
        }

        function addTag(evt){
            let tag = $("#tag");
            if (evt.keyCode == 13){
                evt.preventDefault();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '/api/tags',
                    method: 'post',
                    data:{tag:tag.val()},
                    success: (res) => {
                        res = res.tag;
                        $('<div class="col" >' +
                            '<div class="form-check form-block">' +
                            '<input class="form-check-input" type="checkbox" value="'+res.id+'" id="example-checkbox-block'+res.id+'" name="tags[]">' +
                            '<label class="form-check-label label-check" for="example-checkbox-block'+res.id+'" >' +
                            '<span class="d-block fs-sm text-muted">'+res.name+'</span>' +
                            '</label></div></div>').appendTo('.tag-div');
                        tag.val('');
                    }
                });
            }
        }

        function updateUserStatus(url) {
            return $.ajax({
                url: url,
                method: 'patch',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            })
        }

        const core = {
            ajaxProductList: "{{ route('admin.product.ajax_products') }}",
            ajaxCategoriesList: "{{ route('admin.category.ajax_categories') }}",
            ajaxProductCreate: "{{ route('admin.product.ajax_create') }}",
            ajaxRolesList: "{{ route('admin.roles.ajax_roles') }}",
            updateUserStatus: "{{ route('admin-user-change-status', ['id' => ':id']) }}",
        }
    </script>
    @yield('admin-script')
@endsection
