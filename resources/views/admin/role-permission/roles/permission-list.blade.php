@extends('layouts.admin')

@section('title', 'Admin Dashboard : CPS')

@section('admin-content')
<!-- Main Container -->
<main id="main-container">
    <!-- Page Content -->
    <div class="content">
        <!-- Dynamic Table Full -->
        @if(session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Attach permission for "{{ $role->name }}"</h3>
                <div class="block-options">
                    <button id="save-permission" class="btn btn-sm btn-alt-success">Save Permission</button>
                </div>
            </div>
            <div class="block-content block-content-full">
                <form action="{{ route('admin.roles.attach-permission') }}" method="post">
                    @csrf
                    <input type="hidden" name="role_id" value="{{ $role->id }}">
                    @foreach($permissions_module as $module_key => $module)
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            {{ $module['name'] }}
                        </div>
                        <div class="block-content block-content-full">
                            <div class="row">
                                @foreach($module['permission'] as $permission_key => $permission)
                                    <div class="col-4 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="{{$module_key.'-'.$permission_key}}" value="{{ $permission['id'] }}" name="permission[]" @if(in_array( $permission['id'] ,$attach_permission)) checked @endif>
                                            <label class="form-check-label" for="{{$module_key.'-'.$permission_key}}">
                                                {{ $permission['name'] }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-sm btn-alt-success">Save Permission</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
<!-- END Main Container -->
@endsection

@section('admin-script')
<script>
    $('#save-permission').on('click', function() {
        $('form').submit();
    });
</script>

@endsection
