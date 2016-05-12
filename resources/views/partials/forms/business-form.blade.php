@if($showOwnerSection == "Yes")
    <div class="form-group">
        {{ Form::label('owner_name', 'Name:', ['class' => 'col-sm-2 control-label']) }}
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
    {{ Form::label('type', 'Type:', ['class' => 'col-sm-2 control-label']) }}
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
    {{ Form::label('membership_plan', 'Membership Plan:', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        {{ Form::select('membership_plan', $membership_plans, $plan, ['placeholder' => 'Pick a membership plan', 'class' => 'form-control']) }}
    </div>
</div>
@if($showStatusSection == "Yes")
    <div class="hr-line-dashed"></div>
    <div class="form-group">
        {{ Form::label('status', 'Status:', ['class' => 'col-sm-2 control-label']) }}
        <div class="col-sm-10">
            <input name="active" type="checkbox" @if ($business->active == 1) checked
                   @endif data-toggle="toggle" data-onstyle="primary"
                   data-on="Active" data-off="Inactive" data-offstyle="danger">
        </div>
    </div>
@endif
<div class="hr-line-dashed"></div>
<div class="form-group">
    {{ Form::label('description', 'Description (Note):', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        {{ Form::textarea('description', null, ['placeholder' => 'Description' , 'class' => 'form-control']) }}
    </div>
</div>
<div class="hr-line-dashed"></div>
<div class="form-group">
    <div class="col-sm-1 col-sm-offset-2">
        {{ Form::submit($submitButtonText, ['class' => 'btn btn-primary']) }}
    </div>
</div>