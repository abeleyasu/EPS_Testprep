@extends('layouts.main')

@section('page-content')
<div id="page-container" class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed">
    @include('components.admin-nav')
    @include('components.admin-header')

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

    <script>
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
    </script>
    @yield('admin-script')
@endsection
