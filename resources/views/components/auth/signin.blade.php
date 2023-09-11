<form class="js-validation-signin" action="{{route('post-signin')}}" method="POST" autocomplete="off">
    @csrf
    <div class="py-3">
        <div class="mb-4">
            <label for="email" class="form-label fs-6 text-body">Enter Email</label>
            <input type="text" class="form-control form-control-alt form-control-lg {{$errors->has('email') ? 'is-invalid' : ''}}" id="login-email" name="email" placeholder="Email" value="{{old('email')}}">
            @error('email')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label for="password" class="form-label fs-6 text-body">Enter Password</label>
            <input type="password" class="form-control form-control-alt form-control-lg {{$errors->has('password') ? 'is-invalid' : ''}}" id="login-password" name="password" placeholder="Password">
            @error('password')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        <div class="mb-4">
            <div class="form-check @if(isset($sign_btn_hide)) fs-6 @endif">
                <input class="form-check-input" type="checkbox" value="" id="remember" name="remember">
                <label class="form-check-label" for="login-remember">Remember Me</label>
            </div>
        </div>
    </div>
    @if(!isset($sign_btn_hide))
    <div class="row mb-4">
        <div class="col-md-6 col-xl-5">
            <button type="submit" class="btn w-100 btn-alt-primary">
                <i class="fa fa-fw fa-sign-in-alt me-1 opacity-50"></i> Sign In
            </button>
        </div>
    </div>
    @endif
</form>