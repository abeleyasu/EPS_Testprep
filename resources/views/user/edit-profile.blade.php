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

    .updatebtn {
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        background-clip: padding-box;
        border: 1px solid #dfe3ea;
        border-radius: 0.25rem;
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
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
                        @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <div style="display: flex;">
                            <div class="form-group col-md-5">
                                <label for="image">Profile Picture:</label>
                                <input type="file" class="form-control" id="image" name="image" onchange="previewImage(event)">
                                <!-- <label>Preview</label><br> -->
                                <img id="preview" src="" alt="" style="max-width: 100px; margin-top: 10px;">
                            </div>
                            <div class="form-group" style="margin-left: 2rem;">
                                <img class="profile_pic" id="preview" src="{{ $user->profile_pic ? asset('profile_images/' . $user->profile_pic) :  asset('assets/media/avatars/no-user-image.png') }}" alt="No Image" height="150" style="mix-blend-mode: multiply;">
                            </div>
                        </div>
                        <div class="mb-4 col-md-5">
                            <label for="">User Role</label>
                            <div class="form-control form-control-lg form-control-alt">{{ $user->userrole->name }}</div>
                        </div>
                        <div class="mb-4 col-md-5">
                            <label for="">First Name</label>
                            <input type="text" class="form-control form-control-lg form-control-alt {{$errors->has('first_name') ? 'is-invalid' : ''}}" id="first_name" name="first_name" placeholder="First Name" value="{{$user->first_name}}">
                            @error('first_name')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-4 col-md-5">
                            <label for="">Last Name</label>
                            <input type="text" class="form-control form-control-lg form-control-alt {{$errors->has('last_name') ? 'is-invalid' : ''}}" id="last_name" name="last_name" placeholder="Last Name" value="{{$user->last_name}}">
                            @error('last_name')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-4 col-md-5">
                            <label for="">Phone Number</label>
                            <input type="text" class="form-control form-control-lg form-control-alt {{$errors->has('phone') ? 'is-invalid' : ''}}" id="phone" name="phone" placeholder="Phone" value="{{$user->phone}}">
                            @error('phone')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-4 col-md-5">
                            <label for="">Parent Phone Number (Optional)</label>
                            <input type="text" class="form-control form-control-lg form-control-alt {{$errors->has('parent_phone') ? 'is-invalid' : ''}}" id="parent_phone" name="parent_phone" placeholder="Parent Phone Number (Optional)" value="{{$user->parent_phone}}">
                            @error('parent_phone')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <input type="text" name="id" value="{{$user->id}}" hidden>
                    <div class="mb-4 col-md-5">
                        <div class="">
                            <button type="submit" class="btn w-100 btn-alt-success updatebtn">
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
<script>
    function previewImage(event) {
        var preview = document.getElementById('preview');
        preview.src = URL.createObjectURL(event.target.files[0]);
    }
</script>
<!-- END Main Container -->
@endsection

@section('user-script')

@endsection