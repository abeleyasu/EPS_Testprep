<div class="mb-3">
    <h6>Note:</h6> 
    <ol class="list-group list-group-numbered">
        <li>All these permissions are for new registered they will get these permissions.</li>
        <li>If you want to hide and show any permission for free user you can change from here.</li>
        <li>When you update interval count and interval type it will be applied for newly registered user. It will not affect the current user.</li>
        <li>The free subscription for the new user will be deactivated when you toggle off.</li>
    </ol>
</div>
<form action="{{ route('admin.setting.subscription-settings') }}" method="POST" id="free-subscription-permission">
    @csrf
    <div class="mb-2">
        <label for="is_free_access" class="form-label">Active/Deactive Free User Subscription</label>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="is_free_access" name="is_free_access" @if($setting->is_free_access) checked @endif>
        </div>
    </div>
    
    <div class="mb-4">
        <div class="row">
            <div class="col-6">
                <label for="free_access_interval_count">Free Access Interval Count</label>
                <input type="text" class="form-control form-control-lg form-control-alt" name="free_access_interval_count" id="free_access_interval_count" value="{{ $setting->free_access_interval_count }}">
            </div>
            <div class="col-6">
                <label for="free_access_interval_type">Free Access Interval Type</label>
                <select name="free_access_interval_type" id="free_access_interval_type" class="form-control form-control-lg form-control-alt">
                    <option value="day" @if($setting->free_access_interval_type == 'day') selected @endif>Days</option>
                    <option value="week" @if($setting->free_access_interval_type == 'week') selected @endif>Week</option>
                    <option value="month" @if($setting->free_access_interval_type == 'month') selected @endif>Month</option>
                </select>
            </div>
        </div>
    </div>
    
    @foreach($permissions_module as $module_key => $module)
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                {{ $module['name'] }}
            </div>
            <div class="block-content block-content-full">
                <div class="row">
                    @foreach($module['permission'] as $permission_key => $permission)
                        <div class="col-3 mb-2">
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

    <div class="mt-2 mv-2 text-end">
        <button type="submit" class="btn btn-alt-success">Save Setting</button>
    </div>
</form>