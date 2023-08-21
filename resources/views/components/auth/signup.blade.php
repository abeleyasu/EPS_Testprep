@inject('userroles', 'App\Models\UserRole')

<form class="js-validation-signup" id="register" action="{{route('post-signup')}}" method="POST" autocomplete="off">
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
            <input type="password" autocomplete="new-password" class="form-control form-control-lg form-control-alt {{$errors->has('password') ? 'is-invalid' : ''}}" id="password" name="password" placeholder="Password">
            @error('password')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        <div class="mb-4">
            <input type="password" autocomplete="new-password" class="form-control form-control-lg form-control-alt {{$errors->has('password_confirmation') ? 'is-invalid' : ''}}" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password">
            @error('password_confirmation')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        <div class="mb-4">
            <select name="role" class="form-control form-control-lg form-control-alt {{$errors->has('role') ? 'is-invalid' : ''}}">
                <option value="">Select User Role</option>
                @php 
                    $roles = $userroles::where([
                        ['slug','!=','super_admin'],
                        ['is_visible',1]
                    ])->get(); 
                @endphp
                @foreach($roles as $role)
                    <option value="{{$role->id}}">{{$role->name}}</option>
                @endforeach
            </select>
            @error('role')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        
        <div class="mb-4">
            <div class="form-check">
                <input class="form-check-input @if(isset($sign_btn_hide)) fs-6 @endif {{$errors->has('terms') ? 'is-invalid' : ''}}" type="checkbox" id="terms" name="terms">
                <label class="form-check-label" for="terms">I agree to Terms &amp; Conditions</label>
            </div>
            @error('terms')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>

        <div class="mb-4">
            <div class="form-check">
                <input class="form-check-input @if(isset($sign_btn_hide)) fs-6 @endif {{$errors->has('is_verifed') ? 'is-invalid' : ''}}" type="checkbox" id="is_verifed" name="is_verifed">
                <label class="form-check-label" for="is_verifed">By providing your number you consent to receive marketing/promotional/notification messages from College Prep System. To opt-out reply STOP on any message, or un-check the consent checkbox and save your profile. Message & Data rates may apply.</label>
            </div>
            @error('is_verifed')
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>

        <div class="mb-4">
            <div class="form-check">
                <input class="form-check-input @if(isset($sign_btn_hide)) fs-6 @endif {{$errors->has('is_receive_emails_newsletters') ? 'is-invalid' : ''}}" type="checkbox" id="is_receive_emails_newsletters" name="is_receive_emails_newsletters">
                <label class="form-check-label" for="is_receive_emails_newsletters">I agrees to receive emails and newsletters for College Prep System</label>
            </div>
            @error('is_receive_emails_newsletters')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
    </div>
    @if(!isset($sign_btn_hide))
    <div class="row mb-4">
        <div class="col-md-6 col-xl-5">
            <button type="submit" class="btn w-100 btn-alt-success">
                <i class="fa fa-fw fa-plus me-1 opacity-50"></i> Sign Up
            </button>
        </div>
    </div>
    @endif
</form>