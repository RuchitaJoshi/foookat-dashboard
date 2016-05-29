<div class="form-group">
    {{ Form::label('name', 'Store Name:', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        {{ Form::text('name', null, ['placeholder' => 'Store Name' , 'class' => 'form-control']) }}
    </div>
</div>
<div class="hr-line-dashed"></div>
<div class="form-group">
    {{ Form::label('overview', 'Overview:', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        {{ Form::textarea('overview', null, ['placeholder' => 'Overview' , 'class' => 'form-control']) }}
    </div>
</div>
<div class="hr-line-dashed"></div>
<div class="form-group">
    {{ Form::label('league', 'League:', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        {{ Form::select('league', $leagues, null, ['placeholder' => 'Pick a league', 'class' => 'form-control']) }}
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
        <div class="input-group m-b">
            <span style="background-color: #e5e6e7" class="input-group-addon">+91</span> {{ Form::text('mobile_number', null, ['placeholder' => 'Mobile Number' , 'class' => 'form-control']) }}
        </div>
    </div>
</div>
<div class="hr-line-dashed"></div>
<div class="form-group">
    {{ Form::label('phone_number', 'Phone Number:', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        {{ Form::text('phone_number', null, ['placeholder' => 'Phone Number' , 'class' => 'form-control']) }}
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
    {{ Form::label('working_hours', 'Working Hours:', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        <div class="input-group m-b">
            <span style="width: 100px;background-color: #e5e6e7" class="input-group-addon">Mon Open</span> {{ Form::text('mon_open', null, ['id' => 'mon_open' , 'class' => 'form-control']) }} <span class="input-group-addon">AM</span><span  style="width: 100px;background-color: #e5e6e7"class="input-group-addon">Mon Close</span> {{ Form::text('mon_close', null, ['id' => 'mon_close' , 'class' => 'form-control']) }} <span class="input-group-addon">PM</span>
        </div>
        <div class="input-group m-b">
            <span style="width: 100px;background-color: #e5e6e7" class="input-group-addon">Tue Open</span> {{ Form::text('tue_open', null, ['id' => 'tue_open' , 'class' => 'form-control']) }} <span class="input-group-addon">AM</span><span style="width: 100px;background-color: #e5e6e7" class="input-group-addon">Tue Close</span> {{ Form::text('tue_close', null, ['id' => 'tue_close' , 'class' => 'form-control']) }} <span class="input-group-addon">PM</span>
        </div>
        <div class="input-group m-b">
            <span style="width: 100px;background-color: #e5e6e7" class="input-group-addon">Wed Open</span> {{ Form::text('wed_open', null, ['id' => 'wed_open' , 'class' => 'form-control']) }} <span class="input-group-addon">AM</span><span style="width: 100px;background-color: #e5e6e7" class="input-group-addon">Wed Close</span> {{ Form::text('wed_close', null, ['id' => 'wed_close' , 'class' => 'form-control']) }} <span class="input-group-addon">PM</span>
        </div>
        <div class="input-group m-b">
            <span style="width: 100px;background-color: #e5e6e7" class="input-group-addon">Thu Open</span> {{ Form::text('thu_open', null, ['id' => 'thu_open' , 'class' => 'form-control']) }} <span class="input-group-addon">AM</span><span style="width: 100px;background-color: #e5e6e7" class="input-group-addon">Thu Close</span> {{ Form::text('thu_close', null, ['id' => 'thu_close' , 'class' => 'form-control']) }} <span class="input-group-addon">PM</span>
        </div>
        <div class="input-group m-b">
            <span style="width: 100px;background-color: #e5e6e7" class="input-group-addon">Fri Open</span> {{ Form::text('fri_open', null, ['id' => 'fri_open' , 'class' => 'form-control']) }} <span class="input-group-addon">AM</span><span style="width: 100px;background-color: #e5e6e7" class="input-group-addon">Fri Close</span> {{ Form::text('fri_close', null, ['id' => 'fri_close' , 'class' => 'form-control']) }} <span class="input-group-addon">PM</span>
        </div>
        <div class="input-group m-b">
            <span style="width: 100px;background-color: #e5e6e7" class="input-group-addon">Sat Open</span> {{ Form::text('sat_open', null, ['id' => 'sat_open' , 'class' => 'form-control']) }} <span class="input-group-addon">AM</span><span style="width: 100px;background-color: #e5e6e7" class="input-group-addon">Sat Close</span> {{ Form::text('sat_close', null, ['id' => 'sat_close' , 'class' => 'form-control']) }} <span class="input-group-addon">PM</span>
        </div>
        <div class="input-group m-b">
            <span style="width: 100px;background-color: #e5e6e7" class="input-group-addon">Sun Open</span> {{ Form::text('sun_open', null, ['id' => 'sun_open' , 'class' => 'form-control']) }} <span class="input-group-addon">AM</span><span style="width: 100px;background-color: #e5e6e7" class="input-group-addon">Sun Close</span> {{ Form::text('sun_close', null, ['id' => 'sun_close' , 'class' => 'form-control']) }} <span class="input-group-addon">PM</span>
        </div>
    </div>
</div>
@if($showActiveSection == "Yes")
    <div class="hr-line-dashed"></div>
    <div class="form-group">
        {{ Form::label('active', 'Active:', ['class' => 'col-sm-2 control-label']) }}
        <div class="col-sm-10">
            <input name="active" type="checkbox" @if ($business->active == 1) checked
                   @endif data-toggle="toggle" data-onstyle="primary"
                   data-on="Active" data-off="Inactive" data-offstyle="danger">
        </div>
    </div>
@endif
@if($showStatusSection == "Yes")
    <div class="hr-line-dashed"></div>
    <div class="form-group">
        {{ Form::label('status', 'Status:', ['class' => 'col-sm-2 control-label']) }}
        <div class="col-sm-10">
            {{ Form::select('status', ['Pending' => 'Pending', 'Approved' => 'Approved', 'Rejected' => 'Rejected'], null, ['placeholder' => 'Pick a status', 'class' => 'form-control']) }}
        </div>
    </div>
@endif
<div class="hr-line-dashed"></div>
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