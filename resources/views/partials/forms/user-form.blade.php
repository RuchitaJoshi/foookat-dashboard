<div class="form-group">
    {{ Form::label('name', 'Name:', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        {{ Form::text('name', null, ['placeholder' => 'Name' , 'class' => 'form-control']) }}
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
@if($showStatusSection == "Yes")
    <div class="hr-line-dashed"></div>
    <div class="form-group">
        {{ Form::label('active', 'Active:', ['class' => 'col-sm-2 control-label']) }}
        <div class="col-sm-10">
            <input name="active" type="checkbox" @if ($user->active == 1) checked
                   @endif data-toggle="toggle" data-onstyle="primary"
                   data-on="Active" data-off="Inactive" data-offstyle="danger">
        </div>
    </div>
@endif
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
<div class="form-group">
    {{ Form::label('profile_picture', 'Profile Picture:', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        <img style="width:150px;height:150px;float:left;" id="img_profile_picture"
             @if (isset($user) && $user->profile_picture) src="{{ $user->profile_picture }}"
             @else src="{{ URL::asset('images/uploads/avatars/default.png') }}" @endif>
        <div class="col-sm-10">
            {{ Form::file('profile_picture', null, ['id' => 'profile_picture', 'class' => 'form-control']) }}
            @if (isset($user) && $user->profile_picture)
                <a class="btn btn-sm btn-danger" style="margin-top: 10px" type="button" onClick="deleteProfilePicture({{ $user->id }})"><i
                            class="fa fa-trash"></i> Delete</a>
            @endif
        </div>
    </div>
</div>
<div class="hr-line-dashed"></div>
<div class="form-group">
    <div class="col-sm-1 col-sm-offset-2">
        {{ Form::submit($submitButtonText, ['class' => 'btn btn-primary']) }}
    </div>
</div>