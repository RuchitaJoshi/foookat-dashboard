<div class="form-group">
    {{ Form::label('name', 'Name:', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        {{ Form::text('name', null, ['placeholder' => 'Name' , 'class' => 'form-control']) }}
    </div>
</div>
<div class="hr-line-dashed"></div>
<div class="form-group">
    {{ Form::label('commission', 'Commission (%):', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        {{ Form::text('commission', null, ['placeholder' => 'Commission' , 'class' => 'form-control']) }}
    </div>
</div>
<div class="hr-line-dashed"></div>
<div class="form-group">
    {{ Form::label('order', 'Order:', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        {{ Form::number('order', null, ['placeholder' => 'Order' , 'class' => 'form-control']) }}
    </div>
</div>
@if($showStatusSection == "Yes")
    <div class="hr-line-dashed"></div>
    <div class="form-group">
        {{ Form::label('status', 'Status:', ['class' => 'col-sm-2 control-label']) }}
        <div class="col-sm-10">
            <input name="active" type="checkbox" @if ($category->active == 1) checked
                   @endif data-toggle="toggle" data-onstyle="primary"
                   data-on="Active" data-off="Inactive" data-offstyle="danger">
        </div>
    </div>
@endif
<div class="hr-line-dashed"></div>
<div class="form-group">
    <div class="col-sm-1 col-sm-offset-2">
        {{ Form::submit($submitButtonText, ['class' => 'btn btn-primary']) }}
    </div>
</div>