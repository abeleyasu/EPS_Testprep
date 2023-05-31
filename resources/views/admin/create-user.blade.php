@extends('layouts.admin')

@section('title', 'Admin Dashboard : CPS')

@section('admin-content')
<!-- Main Container -->
<main id="main-container">
    <!-- Page Content -->
    <div class="content">
        <!-- Dynamic Table Full -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Add User</h3>
            </div>
            <div class="block-content block-content-full">
                <form action="{{route('admin-post-create-user')}}" method="POST">
                    @csrf
                    <div class="py-3">
                        <div class="mb-4">
                            <input type="text" class="form-control form-control-lg form-control-alt {{$errors->has('first_name') ? 'is-invalid' : ''}}" id="first_name" name="first_name" placeholder="First Name" value="{{old('first_name')}}">
                            @error('first_name')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <input type="text" class="form-control form-control-lg form-control-alt {{$errors->has('last_name') ? 'is-invalid' : ''}}" id="last_name" name="last_name" placeholder="Last Name" value="{{old('last_name')}}">
                            @error('last_name')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <input type="email" class="form-control form-control-lg form-control-alt {{$errors->has('email') ? 'is-invalid' : ''}}" id="email" name="email" placeholder="Email" value="{{old('email')}}">
                            @error('email')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <input type="text" class="form-control form-control-lg form-control-alt {{$errors->has('phone') ? 'is-invalid' : ''}}" id="phone" name="phone" placeholder="Phone" value="{{old('phone')}}">
                            @error('phone')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <input type="password" class="form-control form-control-lg form-control-alt {{$errors->has('password') ? 'is-invalid' : ''}}" id="password" name="password" placeholder="Password">
                            @error('password')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-6 col-xl-5">
                            <button type="submit" class="btn w-100 btn-alt-success">
                                <i class="fa fa-fw fa-plus me-1 opacity-50"></i> Add User
                            </button>
                        </div>
                    </div>
                </form>
                <!-- END Edit User Form -->
            </div>
        </div>
    </div>
</main>
<!-- END Main Container -->
@endsection
