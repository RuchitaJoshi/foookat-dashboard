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
<div class="hr-line-dashed"></div>
<div class="form-group">
    {{ Form::label('role', 'Role:', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        {{ Form::select('role', ['Super Admin' => 'Super Admin', 'System Admin' => 'System Admin'], null, ['placeholder' => 'Pick a role', 'class' => 'form-control']) }}
    </div>
</div>
@if($showStatusSection == "Yes")
    <div class="hr-line-dashed"></div>
    <div class="form-group">
        {{ Form::label('status', 'Status (Portal Access):', ['class' => 'col-sm-2 control-label']) }}
        <div class="col-sm-10">
            <input name="portal_active" type="checkbox" @if ($admin->portal_active == 1) checked
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
    <div class="col-sm-1 col-sm-offset-2">
        {{ Form::submit($submitButtonText, ['class' => 'btn btn-primary']) }}
    </div>
</div>