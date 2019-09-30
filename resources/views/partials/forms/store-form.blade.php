<div class="form-group">
    {{ Form::label('name', 'Store Name:', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        {{ Form::text('name', null, ['placeholder' => 'Store Name' , 'class' => 'form-control']) }}
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
            <span style="background-color: #e5e6e7"
                  class="input-group-addon">+91</span> {{ Form::text('mobile_number', null, ['placeholder' => 'Mobile Number' , 'class' => 'form-control']) }}
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
    <div style="float: right; padding: 10px;" class="col-sm-10 alert alert-info" role="alert">Info! Please select store
        league for e.g Restaurant.
    </div>
</div>
<div class="form-group">
    {{ Form::label('league', 'Store League:', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        {{ Form::select('league', $leagues, null, ['placeholder' => 'Pick a league', 'class' => 'form-control']) }}
    </div>
</div>
<div class="hr-line-dashed"></div>
<div class="form-group">
    <div style="float: right; padding: 10px;" class="col-sm-10 alert alert-info" role="alert">Info! Please select
        00:00:00 as start time and end time if the store is closed.
    </div>
</div>
<div class="form-group">
    {{ Form::label('working_hours', 'Working Hours:', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        <div class="input-group m-b">
            <span style="width: 60px;background-color: #e5e6e7"
                  class="input-group-addon">Mon</span> {{ Form::text('mon_open', null, ['id' => 'mon_open' , 'class' => 'form-control']) }}
            <span class="input-group-addon">To</span>{{ Form::text('mon_close', null, ['id' => 'mon_close' , 'class' => 'form-control']) }}
        </div>
        <div class="input-group m-b">
            <span style="width: 60px;background-color: #e5e6e7"
                  class="input-group-addon">Tue</span> {{ Form::text('tue_open', null, ['id' => 'tue_open' , 'class' => 'form-control']) }}
            <span class="input-group-addon">To</span>{{ Form::text('tue_close', null, ['id' => 'tue_close' , 'class' => 'form-control']) }}
        </div>
        <div class="input-group m-b">
            <span style="width: 60px;background-color: #e5e6e7"
                  class="input-group-addon">Wed</span> {{ Form::text('wed_open', null, ['id' => 'wed_open' , 'class' => 'form-control']) }}
            <span class="input-group-addon">To</span>{{ Form::text('wed_close', null, ['id' => 'wed_close' , 'class' => 'form-control']) }}
        </div>
        <div class="input-group m-b">
            <span style="width: 60px;background-color: #e5e6e7"
                  class="input-group-addon">Thu</span> {{ Form::text('thu_open', null, ['id' => 'thu_open' , 'class' => 'form-control']) }}
            <span class="input-group-addon">To</span>{{ Form::text('thu_close', null, ['id' => 'thu_close' , 'class' => 'form-control']) }}
        </div>
        <div class="input-group m-b">
            <span style="width: 60px;background-color: #e5e6e7"
                  class="input-group-addon">Fri</span> {{ Form::text('fri_open', null, ['id' => 'fri_open' , 'class' => 'form-control']) }}
            <span class="input-group-addon">To</span>{{ Form::text('fri_close', null, ['id' => 'fri_close' , 'class' => 'form-control']) }}
        </div>
        <div class="input-group m-b">
            <span style="width: 60px;background-color: #e5e6e7"
                  class="input-group-addon">Sat</span> {{ Form::text('sat_open', null, ['id' => 'sat_open' , 'class' => 'form-control']) }}
            <span class="input-group-addon">To</span>{{ Form::text('sat_close', null, ['id' => 'sat_close' , 'class' => 'form-control']) }}
        </div>
        <div class="input-group m-b">
            <span style="width: 60px;background-color: #e5e6e7"
                  class="input-group-addon">Sun</span> {{ Form::text('sun_open', null, ['id' => 'sun_open' , 'class' => 'form-control']) }}
            <span class="input-group-addon">To</span>{{ Form::text('sun_close', null, ['id' => 'sun_close' , 'class' => 'form-control']) }}
        </div>
    </div>
</div>
@if($showActiveSection == "Yes")
    <div class="hr-line-dashed"></div>
    <div class="form-group">
        <div style="float: right; padding: 10px;" class="col-sm-10 alert alert-warning" role="alert">Warning! This Store
            and it's deals won't be accessible on the apps if active field is inactive.
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
        <div style="float: right; padding: 10px;" class="col-sm-10 alert alert-warning" role="alert">Warning! This Store
            and its' deals won't be accessible on the apps if approved field is pending or rejected.
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
    <div style="float: right; padding: 10px;" class="col-sm-10 alert alert-info" role="alert">Info! Please provide store
        overview.
    </div>
</div>
<div class="form-group">
    {{ Form::label('overview', 'Store Overview:', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        {{ Form::textarea('overview', null, ['placeholder' => 'Overview' , 'class' => 'form-control']) }}
    </div>
</div>
<div class="hr-line-dashed"></div>
<div class="form-group">
    {{ Form::label('images', 'Store images:', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        <div style="float: left;">
            <img style="width:200px;height:200px;float:left;" id="img_image1"
                 @if (isset($store) && $store->image1) src="{{ $store->image1 }}"
                 @else src="{{ URL::asset('images/uploads/avatars/image.png') }}" @endif>
            <div>
                <input name="image1" id="image1" type="file">
                <label style="display: block"><input style="margin-right: 10px;" type="radio" value="image1"
                                                     id="image1Radio" name="cover"
                                                     @if (isset($store->cover_image1) && $store->cover_image1 == 1) checked="checked" @endif>Set
                    as a cover
                    image</label>
                @if (isset($store) && $store->image1)
                    <a class="btn btn-sm btn-danger" type="button"
                       onClick="deleteStoreImage({{ $store->id }}, '1')"><i
                                class="fa fa-trash"></i> Delete</a>
                @endif
            </div>
        </div>
        <div style="float: left;">
            <img style="width:200px;height:200px;float:left;" id="img_image2"
                 @if (isset($store) && $store->image2) src="{{ $store->image2 }}"
                 @else src="{{ URL::asset('images/uploads/avatars/image.png') }}" @endif>
            <div>
                <input name="image2" id="image2" type="file">
                <label style="display: block"><input style="margin-right: 10px;" type="radio" value="image2"
                                                     id="image2Radio" name="cover"
                                                     @if (isset($store->cover_image2) && $store->cover_image2 == 1) checked="checked" @endif>Set
                    as a cover
                    image</label>
                @if (isset($store) && $store->image2)
                    <a class="btn btn-sm btn-danger" type="button"
                       onClick="deleteStoreImage({{ $store->id }}, '2')"><i
                                class="fa fa-trash"></i> Delete</a>
                @endif
            </div>
        </div>
        <div style="float: left;">
            <img style="width:200px;height:200px;float:left;" id="img_image3"
                 @if (isset($store) && $store->image3) src="{{ $store->image3 }}"
                 @else src="{{ URL::asset('images/uploads/avatars/image.png') }}" @endif>
            <div>
                <input name="image3" id="image3" type="file">
                <label style="display: block"><input style="margin-right: 10px;" type="radio" value="image3"
                                                     id="image3Radio" name="cover"
                                                     @if (isset($store->cover_image3) && $store->cover_image3 == 1) checked="checked" @endif>Set
                    as a cover
                    image</label>
                @if (isset($store) && $store->image3)
                    <a class="btn btn-sm btn-danger" type="button"
                       onClick="deleteStoreImage({{ $store->id }}, '3')"><i
                                class="fa fa-trash"></i> Delete</a>
                @endif
            </div>
        </div>
    </div>
</div>
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