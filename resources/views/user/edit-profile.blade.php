@extends('layouts.user')

@section('title', 'User Dashboard : CPS')

@section('user-content')
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
                    <form action="{{ route('user.edit-profile') }}" method="POST">
                        @csrf
                        <div class="py-3">
                            <div class="mb-4">
                                <input type="text"
                                    class="form-control form-control-lg form-control-alt {{ $errors->has('first_name') ? 'is-invalid' : '' }}"
                                    id="first_name" name="first_name" placeholder="First Name"
                                    value="{{ $user->first_name }}">
                                @error('first_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <input type="text"
                                    class="form-control form-control-lg form-control-alt {{ $errors->has('last_name') ? 'is-invalid' : '' }}"
                                    id="last_name" name="last_name" placeholder="Last Name" value="{{ $user->last_name }}">
                                @error('last_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <input type="email"
                                    class="form-control form-control-lg form-control-alt {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                    id="email" name="email" value="{{ $user->email }}" readonly>
                            </div>
                            <div class="mb-4">
                                <input type="text"
                                    class="form-control form-control-lg form-control-alt {{ $errors->has('phone') ? 'is-invalid' : '' }}"
                                    id="phone" name="phone" placeholder="Phone" value="{{ $user->phone }}">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <input type="password"
                                    class="form-control form-control-lg form-control-alt {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                    id="password" name="password" placeholder="Password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <input type="text" name="id" value="{{ $user->id }}" hidden>
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
                                    <img class="profile_pic" id="preview" src="{{ $user->profile_pic ? asset('profile_images/' . $user->profile_pic) : asset('images/no_image.png') }}" alt="No Image" height="150">
                                </div>
                            </div>
                            <input type="text" name="id" value="{{ $user->id }}" hidden>
                            <div class="row mb-4">
                                <div id="button" class="col-md-6 col-xl-5">
                                    <button type="submit" class="btn w-100 btn-alt-success">
                                        <i class="fa fa-fw fa-pencil me-1 opacity-50"></i> Update Profile
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <!-- END Main Container -->
@endsection

@section('user-script')

    <script>
        $(document).ready(function() {
            getCity($('#billing_state').val());
                $('#billing_state').on('change', function() {
                    getCity(this.value);
                })
        });

        function getCity(state_id) {
            const city_id = $('#city_id').val()
            $.ajax({
                url: 'get-cities/' + state_id,
                method: 'get',
                success: function(data) {
                    $('#billing_city').empty()
                    let city_options = ''
                    data.forEach(element => {

                        city_options += `<option ${city_id == element.id ? 'selected' : null} value="${element.id}">${element.city_name}</option>`
                    });
                    $('#billing_city').html(city_options)
                }
            })
        }
        function previewImage(event) {
            var preview = document.getElementById('preview');
            preview.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
@endsection
