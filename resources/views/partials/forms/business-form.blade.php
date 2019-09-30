@if($showOwnerSection == "Yes")
    <div class="form-group">
        {{ Form::label('owner_name', 'Owner Name:', ['class' => 'col-sm-2 control-label']) }}
        <div class="col-sm-10">
            {{ Form::text('owner_name', null, ['placeholder' => 'Name' , 'class' => 'form-control']) }}
        </div>
    </div>
    <div class="hr-line-dashed"></div>
    <div class="form-group">
        {{ Form::label('email', 'Email:', ['class' => 'col-sm-2 control-label']) }}
        <div class="col-sm-10">
            {{ Form::email('email', null, ['placeholder' => 'Email' , 'class' => 'form-control']) }}
        </div>
    </div>
    <div class="hr-line-dashed"></div>
    <div class="form-group">
        {{ Form::label('mobile_number', 'Mobile Number:', ['class' => 'col-sm-2 control-label']) }}
        <div class="col-sm-10">
            {{ Form::text('mobile_number', null, ['placeholder' => 'Mobile Number' , 'class' => 'form-control']) }}
        </div>
    </div>
    <div class="hr-line-dashed"></div>
    <div class="form-group">
        {{ Form::label('password', 'Password:', ['class' => 'col-sm-2 control-label']) }}
        <div class="col-sm-10">
            {{ Form::password('password', ['placeholder' => 'Password' , 'class' => 'form-control']) }}
        </div>
    </div>
    <div class="hr-line-dashed"></div>
    <div class="form-group">
        {{ Form::label('password_confirmation', 'Confirm Password:', ['class' => 'col-sm-2 control-label']) }}
        <div class="col-sm-10">
            {{ Form::password('password_confirmation', ['placeholder' => 'Confirm Password' , 'class' => 'form-control']) }}
        </div>
    </div>
    <div class="hr-line-dashed"></div>
@endif
<div class="form-group">
    {{ Form::label('name', 'Business Name:', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        {{ Form::text('name', null, ['placeholder' => 'Business Name' , 'class' => 'form-control']) }}
    </div>
</div>
<div class="hr-line-dashed"></div>
<div class="form-group">
    {{ Form::label('logo', 'Business Logo:', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        <img style="width:200px;height:200px;float:left;" id="img_logo"
             @if (isset($business) && $business->logo) src="{{ $business->logo }}"
             @else src="{{ URL::asset('images/uploads/avatars/logo.png') }}" @endif>
        <div class="col-sm-10">
            {{ Form::file('logo', null, ['id' => 'logo', 'class' => 'form-control']) }}
            @if (isset($business) && $business->logo)
                <a class="btn btn-sm btn-danger" style="margin-top: 10px" type="button"
                   onClick="deleteBusinessLogo({{ $business->id }})"><i
                            class="fa fa-trash"></i> Delete</a>
            @endif
        </div>
    </div>
</div>
<div class="form-group">
    {{ Form::label('type', 'Business Type:', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        {{ Form::select('type', ['Retail' => 'Retail', 'Services' => 'Services', 'Retail and Services' => 'Retail and Services'], null, ['placeholder' => 'Pick a type', 'class' => 'form-control']) }}
    </div>
</div>
<div class="hr-line-dashed"></div>
<div class="form-group">
    {{ Form::label('state', 'State:', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        {{ Form::select('state', $states, null, ['placeholder' => 'Pick a state', 'class' => 'form-control', 'onchange' => 'stateChanged()']) }}
    </div>
</div>
<div class="hr-line-dashed"></div>
<div class="form-group">
    {{ Form::label('city', 'City:', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        {{ Form::select('city', $cities, null, ['placeholder' => 'Pick a city', 'class' => 'form-control']) }}
    </div>
</div>
<div class="hr-line-dashed"></div>
<div class="form-group">
    {{ Form::label('address', 'Address:', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        {{ Form::text('address', null, ['placeholder' => 'Address' , 'class' => 'form-control', 'onFocus' => 'geolocate()']) }}
    </div>
</div>
<div class="hr-line-dashed"></div>
<div class="form-group">
    {{ Form::label('zip_code', 'Zip Code:', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        {{ Form::text('zip_code', null, ['placeholder' => 'Zip Code' , 'class' => 'form-control']) }}
    </div>
</div>
<div class="hr-line-dashed"></div>
<div class="form-group">
    <div style="float: right; padding: 10px;" class="col-sm-10 alert alert-info" role="alert">Info! Please select a membership plan.
    </div>
</div>
<div class="form-group">
    {{ Form::label('membership_plan', 'Membership Plan:', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        {{ Form::select('membership_plan', $membership_plans, $plan, ['placeholder' => 'Pick a membership plan', 'class' => 'form-control']) }}
    </div>
</div>
@if($showActiveSection == "Yes")
    <div class="hr-line-dashed"></div>
    <div class="form-group">
        <div style="float: right; padding: 10px;" class="col-sm-10 alert alert-warning" role="alert">Warning! This
            business, it's stores and it's deals won't be accessible on the apps if active field is inactive.
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('active', 'Active:', ['class' => 'col-sm-2 control-label']) }}
        <div class="col-sm-10">
            <input name="active" type="checkbox" @if ($business->active == 1) checked
                   @endif data-toggle="toggle" data-onstyle="primary"
                   data-on="Active" data-off="Inactive" data-offstyle="danger">
        </div>
    </div>
@endif
@if($showApprovedSection == "Yes")
    <div class="hr-line-dashed"></div>
    <div class="form-group">
        <div style="float: right; padding: 10px;" class="col-sm-10 alert alert-warning" role="alert">Warning! This
            business, it's stores and its' deals won't be accessible on the apps if approved field is pending or
            rejected.
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('approved', 'Approved:', ['class' => 'col-sm-2 control-label']) }}
        <div class="col-sm-10">
            {{ Form::select('approved', ['Pending' => 'Pending', 'Approved' => 'Approved', 'Rejected' => 'Rejected'], null, ['placeholder' => 'Pick a status', 'class' => 'form-control']) }}
        </div>
    </div>
@endif
<div class="hr-line-dashed"></div>
<div class="form-group">
    <div style="float: right; padding: 10px;" class="col-sm-10 alert alert-info" role="alert">Info! Provide any
        suggestions or special considerations.
    </div>
</div>
<div class="form-group">
    {{ Form::label('note', 'Note:', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        {{ Form::textarea('note', null, ['placeholder' => 'Note' , 'class' => 'form-control']) }}
    </div>
</div>
<div class="hr-line-dashed"></div>
<div class="form-group">
    <div class="col-sm-1 col-sm-offset-2">
        {{ Form::submit($submitButtonText, ['class' => 'btn btn-primary']) }}
    </div>
</div>