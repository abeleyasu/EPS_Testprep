@extends('layouts.admin')

@section('title', 'Admin Dashboard : CPS')

@section('page-style')
  <!-- Stylesheets -->
  <!-- Page JS Plugins CSS -->
  <link rel="stylesheet" href="{{asset('assets/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/css/select2/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/initial-college-list.css') }}">
@endsection

@section('admin-content')
<!-- Main Container -->
<main id="main-container">
  <div class="content">
    @if(session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif

    @if(session('error'))
      <div class="alert alert-error">
        {{ session('error') }}
      </div>
    @endif
    <div class="block block-rounded">
      <div class="block-header block-header-tab">
        <h3 class="block-title text-white">Settings</h3>
      </div>
      <div class="block-content block-content-full">
        <div class="tab-content" id="myTabContent">
          <div class="setup-content" role="tabpanel" id="step1" aria-labelledby="step1-tab">
            <div class="accordion accordionExample">
              <div class="block block-rounded block-bordered overflow-hidden mb-1">
                  <div class="block-header block-header-tab" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <a class="text-white fw-600 collapsed"><i class="fa-2x fa fa-fw fa-file-lines"></i> Free User Subscription Setting</a>
                  </div>
                  <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-bs-parent=".accordionExample">
                    <div class="college-content-wrapper college-content">
                      @include("admin.settings.components.free-user-role", [
                        'permissions_module' => $permissions_module,
                        'attach_permission' => $attached_permissions,
                        'role' => $role,
                        'setting' => $settings
                      ])
                    </div>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<!-- END Main Container -->
@endsection

@section('admin-script')
@endsection
