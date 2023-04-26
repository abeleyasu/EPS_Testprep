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
                <form action="{{route('user.edit-profile')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="py-3">
                        <div class="mb-4">
                            Profile Picture <input type="file" name="image" accept="image/*">
                            <img class="profile_pic" src="{{url('profile_images/'.$user->profile_pic)}}" alt="">
                        </div>
                        <div class="mb-4">
                            <label for="">First Name</label>
                            <input type="text" class="form-control form-control-lg form-control-alt {{$errors->has('first_name') ? 'is-invalid' : ''}}" id="first_name" name="first_name" placeholder="First Name" value="{{$user->first_name}}">
                            @error('first_name')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="">Last Name</label>
                            <input type="text" class="form-control form-control-lg form-control-alt {{$errors->has('last_name') ? 'is-invalid' : ''}}" id="last_name" name="last_name" placeholder="Last Name" value="{{$user->last_name}}">
                            @error('last_name')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="">Email</label>
                            <input type="email" class="form-control form-control-lg form-control-alt {{$errors->has('email') ? 'is-invalid' : ''}}" id="email" name="email" value="{{$user->email}}" readonly>
                        </div>
                        <div class="mb-4">
                            <label for="">Phone Number</label>
                            <input type="text" class="form-control form-control-lg form-control-alt {{$errors->has('phone') ? 'is-invalid' : ''}}" id="phone" name="phone" placeholder="Phone" value="{{$user->phone}}">
                            @error('phone')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
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
                                <i class="fa fa-fw fa-pencil me-1 opacity-50"></i> Update User
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