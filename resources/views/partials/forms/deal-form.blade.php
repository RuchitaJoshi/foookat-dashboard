<div class="form-group">
    {{ Form::label('name', 'Deal Name:', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        {{ Form::text('name', null, ['placeholder' => 'Deal Name' , 'class' => 'form-control']) }}
    </div>
</div>
<div class="hr-line-dashed"></div>
<div class="form-group">
    {{ Form::label('details', 'Deal Details:', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        {{ Form::text('details', null, ['placeholder' => 'Deal Details' , 'class' => 'form-control']) }}
    </div>
</div>
<div class="hr-line-dashed"></div>
<div class="form-group">
    <div style="float: right; padding: 10px;" class="col-sm-10 alert alert-info" role="alert">Info! Please provide an
        original price of a deal.
    </div>
</div>
<div class="form-group">
    {{ Form::label('original_price', 'Original Price:', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        <div class="input-group m-b"><span class="input-group-addon"><i class="fa fa-inr"
                                                                        aria-hidden="true"></i></span> {{ Form::text('original_price', null, ['class' => 'form-control']) }}
        </div>
    </div>
</div>
<div class="hr-line-dashed"></div>
<div class="form-group">
    <div style="float: right; padding: 10px;" class="col-sm-10 alert alert-info" role="alert">Info! Please select a
        discount type from percentage off for e.g 10% off or amount off for e.g <i
                class="fa fa-inr"
                aria-hidden="true"></i>50 off.
    </div>
</div>
<div class="form-group">
    {{ Form::label('discount_type', 'Discount Type:', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        <label class="radio-inline"><input type="radio" value="Percentage Off"
                                           @if (isset($deal->percentage_off)) checked="checked"
                                           @endif name="discount_type">Percentage
            Off</label>
        <label class="radio-inline"><input type="radio" value="Amount Off"
                                           @if (isset($deal->amount_off)) checked="checked" @endif name="discount_type">Amount
            Off</label>
    </div>
</div>
<div @if (!isset($deal->percentage_off)) style="display: none;" @endif id="percentage_off_div">
    <div class="hr-line-dashed"></div>
    <div class="form-group">
        {{ Form::label('percentage_off', 'Percentage Off:', ['class' => 'col-sm-2 control-label']) }}
        <div class="col-sm-10">
            <div class="input-group m-b">{{ Form::text('percentage_off', null, ['class' => 'form-control']) }} <span
                        class="input-group-addon">%</span></div>
        </div>
    </div>
</div>
<div @if (!isset($deal->amount_off)) style="display: none;" @endif id="amount_off_div">
    <div class="hr-line-dashed"></div>
    <div class="form-group">
        {{ Form::label('amount_off', 'Amount Off:', ['class' => 'col-sm-2 control-label']) }}
        <div class="col-sm-10">
            <div class="input-group m-b"><span class="input-group-addon"><i
                            class="fa fa-inr"
                            aria-hidden="true"></i></span> {{ Form::text('amount_off', null, ['class' => 'form-control']) }}
            </div>
        </div>
    </div>
</div>
<div class="hr-line-dashed"></div>
<div class="form-group">
    <div style="float: right; padding: 10px;" class="col-sm-10 alert alert-info" role="alert">Info! New Price will be
        automatically calculated based on discount type provided.
    </div>
</div>
<div class="form-group">
    {{ Form::label('new_price', 'New Price:', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        <div class="input-group m-b"><span class="input-group-addon"><i class="fa fa-inr"
                                                                        aria-hidden="true"></i></span> {{ Form::text('new_price', null, ['class' => 'form-control', 'readonly']) }}
        </div>
    </div>
</div>
<div class="hr-line-dashed"></div>
<div class="form-group">
    <div style="float: right; padding: 10px;" class="col-sm-10 alert alert-info" role="alert">Info! Please select start
        date and end date of a deal.
    </div>
</div>
<div class="form-group">
    {{ Form::label('deal_dates', 'Deal Running Dates:', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        <div class="input-group m-b">
            <span style="width: 100px;background-color: #e5e6e7"
                  class="input-group-addon">Start Date</span> {{ Form::text('start_date', null, ['id' => 'start_date' , 'class' => 'form-control']) }}
            <span class="input-group-addon">To</span><span style="width: 100px;background-color: #e5e6e7"
                                                           class="input-group-addon">End Date</span> {{ Form::text('end_date', null, ['id' => 'end_date' , 'class' => 'form-control']) }}
        </div>
    </div>
</div>
<div class="hr-line-dashed"></div>
<div class="form-group">
    <div style="float: right; padding: 10px;" class="col-sm-10 alert alert-info" role="alert">Info! Please select deal
        running days for e.g deal should go live on sat and sun.
    </div>
</div>
<div class="form-group">
    {{ Form::label('deal_days', 'Deal Running Days:', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        <label class="checkbox-inline"><input type="checkbox" value="mon"
                                              @if (isset($deal->mon) && $deal->mon == 1) checked="checked"
                                              @endif name="deal_days[]">Mon</label>
        <label class="checkbox-inline"><input type="checkbox" value="tue"
                                              @if (isset($deal->tue) && $deal->tue == 1) checked="checked"
                                              @endif name="deal_days[]">Tue</label>
        <label class="checkbox-inline"><input type="checkbox" value="wed"
                                              @if (isset($deal->wed) && $deal->wed == 1) checked="checked"
                                              @endif name="deal_days[]">Wed</label>
        <label class="checkbox-inline"><input type="checkbox" value="thu"
                                              @if (isset($deal->thu) && $deal->thu == 1) checked="checked"
                                              @endif name="deal_days[]">Thu</label>
        <label class="checkbox-inline"><input type="checkbox" value="fri"
                                              @if (isset($deal->fri) && $deal->fri == 1) checked="checked"
                                              @endif name="deal_days[]">Fri</label>
        <label class="checkbox-inline"><input type="checkbox" value="sat"
                                              @if (isset($deal->sat) && $deal->sat == 1) checked="checked"
                                              @endif name="deal_days[]">Sat</label>
        <label class="checkbox-inline"><input type="checkbox" value="sun"
                                              @if (isset($deal->sun) && $deal->sun == 1) checked="checked"
                                              @endif name="deal_days[]">Sun</label>
    </div>
</div>
<div class="hr-line-dashed"></div>
<div class="form-group">
    <div style="float: right; padding: 10px;" class="col-sm-10 alert alert-info" role="alert">Info! Please select
        running hours of a deal for e.g 11:00:00 to 18:00:00.
    </div>
</div>
<div class="form-group">
    {{ Form::label('deal_running_hours', 'Deal Running Hours:', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        <div class="input-group m-b">
            <span style="width: 100px;background-color: #e5e6e7"
                  class="input-group-addon">Start Time</span> {{ Form::text('start_time', null, ['id' => 'start_time' , 'class' => 'form-control']) }}
            <span class="input-group-addon">To</span><span style="width: 100px;background-color: #e5e6e7"
                                                           class="input-group-addon">End Time</span> {{ Form::text('end_time', null, ['id' => 'end_time' , 'class' => 'form-control']) }}
        </div>
    </div>
</div>
<div class="hr-line-dashed"></div>
<div class="form-group">
    <div style="float: right; padding: 10px;" class="col-sm-10 alert alert-info" role="alert">Info! Please enter a
        redeem code not more than 8 characters.
    </div>
</div>
<div class="form-group">
    {{ Form::label('redeem_code', 'Redeem Code:', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        {{ Form::text('redeem_code', null, ['placeholder' => 'Redeem Code' , 'class' => 'form-control']) }}
    </div>
</div>
<div class="hr-line-dashed"></div>
<div class="form-group">
    <div style="float: right; padding: 10px;" class="col-sm-10 alert alert-info" role="alert">Info! Deal will be
        displayed on apps based on selected category.
    </div>
</div>
<div class="form-group">
    {{ Form::label('category', 'Deal Category:', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        {{ Form::select('category', $categories, null, ['placeholder' => 'Pick a category', 'class' => 'form-control']) }}
    </div>
</div>
@if($showActiveSection == "Yes")
    <div class="hr-line-dashed"></div>
    <div class="form-group">
        <div style="float: right; padding: 10px;" class="col-sm-10 alert alert-warning" role="alert">Warning! This deals
            won't be accessible on the apps if active field is inactive.
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
        <div style="float: right; padding: 10px;" class="col-sm-10 alert alert-warning" role="alert">Warning! This deals
            won't be accessible on the apps if approved field is pending or rejected.
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
    {{ Form::label('overview', 'Deal Overview:', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        {{ Form::textarea('overview', null, ['placeholder' => 'Deal Overview' , 'class' => 'form-control']) }}
    </div>
</div>
<div class="hr-line-dashed"></div>
<div class="form-group">
    {{ Form::label('images', 'Deal images:', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        <div style="float: left;">
            <img style="width:200px;height:200px;float:left;" id="img_image1"
                 @if (isset($deal) && $deal->image1) src="{{ $deal->image1 }}"
                 @else src="{{ URL::asset('images/uploads/avatars/image.png') }}" @endif>
            <div>
                <input name="image1" id="image1" type="file">
                <label style="display: block"><input style="margin-right: 10px;" type="radio" value="image1"
                                                     id="image1Radio" name="cover"
                                                     @if (isset($deal->cover_image1) && $deal->cover_image1 == 1) checked="checked" @endif>Set
                    as a cover
                    image</label>
                @if (isset($deal) && $deal->image1)
                    <a class="btn btn-sm btn-danger" type="button"
                       onClick="deleteDealImage({{ $deal->id }}, '1')"><i
                                class="fa fa-trash"></i> Delete</a>
                @endif
            </div>
        </div>
        <div style="float: left;">
            <img style="width:200px;height:200px;float:left;" id="img_image2"
                 @if (isset($deal) && $deal->image2) src="{{ $deal->image2 }}"
                 @else src="{{ URL::asset('images/uploads/avatars/image.png') }}" @endif>
            <div>
                <input name="image2" id="image2" type="file">
                <label style="display: block"><input style="margin-right: 10px;" type="radio" value="image2"
                                                     id="image2Radio" name="cover"
                                                     @if (isset($deal->cover_image2) && $deal->cover_image2 == 1) checked="checked" @endif>Set
                    as a cover
                    image</label>
                @if (isset($deal) && $deal->image2)
                    <a class="btn btn-sm btn-danger" type="button"
                       onClick="deleteDealImage({{ $deal->id }}, '2')"><i
                                class="fa fa-trash"></i> Delete</a>
                @endif
            </div>
        </div>
        <div style="float: left;">
            <img style="width:200px;height:200px;float:left;" id="img_image3"
                 @if (isset($deal) && $deal->image3) src="{{ $deal->image3 }}"
                 @else src="{{ URL::asset('images/uploads/avatars/image.png') }}" @endif>
            <div>
                <input name="image3" id="image3" type="file">
                <label style="display: block"><input style="margin-right: 10px;" type="radio" value="image3"
                                                     id="image3Radio" name="cover"
                                                     @if (isset($deal->cover_image3) && $deal->cover_image3 == 1) checked="checked" @endif>Set
                    as a cover
                    image</label>
                @if (isset($deal) && $deal->image3)
                    <a class="btn btn-sm btn-danger" type="button"
                       onClick="deleteDealImage({{ $deal->id }}, '3')"><i
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