<div class="form-group">
    {{ Form::label('name', 'Name:', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        {{ Form::text('name', null, ['placeholder' => 'Name' , 'class' => 'form-control']) }}
    </div>
</div>
<div class="hr-line-dashed"></div>
<div class="form-group">
    {{ Form::label('state', 'State:', ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        {{ Form::select('state', $states, null, ['placeholder' => 'Pick a state', 'class' => 'form-control']) }}
    </div>
</div>
<div class="hr-line-dashed"></div>
<div class="form-group">
    <div class="col-sm-1 col-sm-offset-2">
        {{ Form::submit($submitButtonText, ['class' => 'btn btn-primary']) }}
    </div>
</div>