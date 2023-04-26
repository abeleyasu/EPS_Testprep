@extends('layouts.user')

@section('title', 'User Dashboard : CPS')

@section('user-content')
<style>
    .profile_pic {
        height: 80px;
        width: 80px;
        border-radius: 40px;
        border: 1px solid black;
        box-shadow: 1px 1px 5px;
    }
</style>
<!-- Main Container -->
<main id="main-container">
    <!-- Page Content -->
    <div class="content">
        <!-- Dynamic Table Full -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Edit User</h3>
            </div>
            <div class="block-content block-content-full">
                <form action="{{route('user.settings')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="py-3">
                        <div class="mb-4">
                            <label for="">Email</label>
                            <input type="email" class="form-control form-control-lg form-control-alt {{$errors->has('email') ? 'is-invalid' : ''}}" id="email" name="email" value="{{$user->email}}">
                        </div>
                        <div class="mb-4">
                            <label for="">Password</label>
                            <input type="password" class="form-control form-control-lg form-control-alt {{$errors->has('password') ? 'is-invalid' : ''}}" id="password" name="password" placeholder="Password">
                            @error('password')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <input type="text" name="id" value="{{$user->id}}" hidden>
                    <div class="row mb-4">
                        <div class="col-md-6 col-xl-5">
                            <button type="submit" class="btn w-100 btn-alt-success">
                                <i class="fa fa-fw fa-pencil me-1 opacity-50"></i> Update
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