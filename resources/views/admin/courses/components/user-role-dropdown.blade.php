@inject('roles', 'App\Models\UserRole')

<div class="mb-2">
    <label for="type" class="form-label">User Type:</label>
    <select name="user_type[]" class="user-type-selection form-control {{$errors->has('user_type') ? 'is-invalid' : ''}}" multiple="multiple">
        @if(isset($selected_user_roles))
            @foreach($selected_user_roles as $role)
                @if($roles->find($role))
                    <option value="{{$role}}" selected="selected">{{ $roles->find($role)->name }}</option>
                @endif
            @endforeach
        @endif
    </select>
    @error('user_type')
        <div class="invalid-feedback">{{$message}}</div>
    @enderror
</div>