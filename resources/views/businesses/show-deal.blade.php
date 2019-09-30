@extends('layouts.app')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>{{ $deal->name }}</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li>
                    <a>Businesses</a>
                </li>
                <li>
                    <a href="{{ route('businesses.all') }}">All</a>
                </li>
                <li>
                    <a href="{{ route('businesses.show', $business->id) }}">{{ $business->name }}</a>
                </li>
                <li class="active">
                    <a href="{{ route('businesses.stores', $business->id) }}">Stores</a>
                </li>
                <li>
                    <a href="{{ route('businesses.stores.show', [$business->id, $store->id]) }}">{{ $store->name }}</a>
                </li>
                <li>
                    <a href="{{ route('businesses.stores.deals', [$business->id, $store->id]) }}">Deals</a>
                </li>
                <li class="active">
                    <strong>{{ $deal->name }}</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Functions</h5>
                    </div>
                    <div class="ibox-content">
                        <div style="padding-left: 0px;float: none" class="col-lg-12">
                            <a href=""
                               class="btn btn-info"> Redeems </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div style="min-height:65px;" class="ibox-title">
                        <h5>{{ $deal->name }}</h5>
                        @if (!empty($deal->deleted_at))
                            <div style="text-align:left" class="col-sm-2 control-label">
                                <span class="label label-danger">Deleted</span>
                            </div>
                        @endif
                        <div style="display:inline-block;float: right">
                            <a href="{{ route('businesses.stores.deals.edit', [$business->id, $store->id, $deal->id]) }}"
                               class="btn btn-success btn-sm"><i class="fa fa-pencil"></i>
                                Edit </a>
                            {!! Form::open(array('method' => 'DELETE', 'style' => 'display: inline-block','route' => ['businesses.stores.deals.destroy', $business->id, $store->id, $deal->id])) !!}
                            <button class="btn btn-sm btn-danger" type="button"
                                    data-toggle="modal"
                                    data-target="#confirmDelete"
                                    data-title="Confirm Delete Deal"
                                    data-message="Are you sure you want to delete this deal?">
                                <i class="fa fa-trash"></i> Delete
                            </button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <div class="ibox-content">
                        <form class="form-horizontal">
                            <div class="form-group">
                                {{ Form::label('name', 'Deal Name:', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-10">
                                    {{ Form::label('name', $deal->name, ['class' => 'control-label']) }}
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                {{ Form::label('details', 'Deal Details:', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-10">
                                    {{ Form::label('details', $deal->details, ['class' => 'control-label']) }}
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                {{ Form::label('original_price', 'Original Price:', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-10">
                                    <i class="fa fa-inr"
                                       aria-hidden="true"></i> {{ Form::label('original_price', $deal->original_price, ['class' => 'control-label']) }}
                                </div>
                            </div>
                            @if (!empty($deal->percentage_off))
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    {{ Form::label('percentage_off', 'Percentage Off:', ['class' => 'col-sm-2 control-label']) }}
                                    <div class="col-sm-10">
                                        {{ Form::label('percentage_off', $deal->percentage_off .' %', ['class' => 'control-label']) }}
                                    </div>
                                </div>
                            @endif
                            @if (!empty($deal->amount_off))
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    {{ Form::label('amount_off', 'Amount Off:', ['class' => 'col-sm-2 control-label']) }}
                                    <div class="col-sm-10">
                                        <i class="fa fa-inr"
                                           aria-hidden="true"></i> {{ Form::label('amount_off', $deal->amount_off, ['class' => 'control-label']) }}
                                    </div>
                                </div>
                            @endif
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                {{ Form::label('new_price', 'New Price:', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-10">
                                    <i class="fa fa-inr"
                                       aria-hidden="true"></i> {{ Form::label('new_price', $deal->new_price, ['class' => 'control-label']) }}
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                {{ Form::label('deal_dates', 'Deal Running Dates:', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-10">
                                    <div class="input-group m-b">
                                        <span style="width: 100px;background-color: #e5e6e7" class="input-group-addon">Start Date</span>
                                        <span style="margin-left: 10px"></span> {{ Form::label('start_date', $deal->start_date, ['class' => 'control-label']) }}
                                        <span style="margin-left: 10px"></span>
                                        <span style="width: 100px;background-color: #e5e6e7" class="input-group-addon">End Date</span>
                                        <span style="margin-left: 10px"></span> {{ Form::label('end_date', $deal->end_date, ['class' => 'control-label']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                {{ Form::label('deal_days', 'Deal Running Days:', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-10">
                                    <label class="checkbox-inline"><input type="checkbox" value="mon"
                                                                          @if ($deal->mon == 1) checked="checked" @endif
                                                                          name="deal_days[]">Mon</label>
                                    <label class="checkbox-inline"><input type="checkbox" value="tue"
                                                                          @if ($deal->tue == 1) checked="checked"
                                                                          @endif name="deal_days[]">Tue</label>
                                    <label class="checkbox-inline"><input type="checkbox" value="wed"
                                                                          @if ($deal->wed == 1) checked="checked"
                                                                          @endif name="deal_days[]">Wed</label>
                                    <label class="checkbox-inline"><input type="checkbox" value="thu"
                                                                          @if ($deal->thu == 1) checked="checked"
                                                                          @endif name="deal_days[]">Thu</label>
                                    <label class="checkbox-inline"><input type="checkbox" value="fri"
                                                                          @if ($deal->fri == 1) checked="checked"
                                                                          @endif name="deal_days[]">Fri</label>
                                    <label class="checkbox-inline"><input type="checkbox" value="sat"
                                                                          @if ($deal->sat == 1) checked="checked"
                                                                          @endif name="deal_days[]">Sat</label>
                                    <label class="checkbox-inline"><input type="checkbox" value="sun"
                                                                          @if ($deal->sun == 1) checked="checked"
                                                                          @endif name="deal_days[]">Sun</label>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                {{ Form::label('deal_running_hours', 'Deal Running Hours:', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-10">
                                    <div class="input-group m-b">
                                        <span style="width: 100px;background-color: #e5e6e7" class="input-group-addon">Start Time</span>
                                        <span style="margin-left: 10px"></span> {{ Form::label('start_time', $deal->start_time, ['class' => 'control-label']) }}
                                        <span style="margin-left: 10px"></span>
                                        <span style="width: 100px;background-color: #e5e6e7" class="input-group-addon">End Time</span>
                                        <span style="margin-left: 10px"></span> {{ Form::label('end_time', $deal->end_time, ['class' => 'control-label']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                {{ Form::label('redeem_code', 'Redeem Code:', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-10">
                                    {{ Form::label('redeem_code', $deal->redeem_code, ['class' => 'control-label']) }}
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                {{ Form::label('category', 'Deal Category:', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-10">
                                    {{ Form::label('category', $deal->category, ['class' => 'control-label']) }}
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                {{ Form::label('status', 'Status:', ['class' => 'col-sm-2 control-label']) }}
                                <div style="text-align:left" class="col-sm-10 control-label">
                                    @if ($deal->status == 'Live Now')
                                        <span class="label label-primary">Live Now</span>
                                    @else
                                        <span class="label label-danger">Offline</span>
                                    @endif
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                {{ Form::label('active', 'Active:', ['class' => 'col-sm-2 control-label']) }}
                                <div style="text-align:left" class="col-sm-10 control-label">
                                    @if ($deal->active == 1)
                                        <span class="label label-primary">Active</span>
                                    @else
                                        <span class="label label-danger">Inactive</span>
                                    @endif
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                {{ Form::label('approved', 'Approved:', ['class' => 'col-sm-2 control-label']) }}
                                <div style="text-align:left" class="col-sm-10 control-label">
                                    @if ($deal->approved == 'Pending')
                                        <span class="label label-warning">Pending</span>
                                    @elseif ($deal->approved == 'Approved')
                                        <span class="label label-primary">Approved</span>
                                    @else
                                        <span class="label label-danger">Rejected</span>
                                    @endif
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                {{ Form::label('overview', 'Deal Overview:', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-10">
                                    {{ Form::textarea('overview', $deal->overview, ['class' => 'form-control', 'readonly']) }}
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                {{ Form::label('images', 'Deal images:', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-10">
                                    <div style="float: left;">
                                        <img style="width:200px;height:200px;" id="img_image1"
                                             @if ($deal->image1) src="{{ $deal->image1 }}"
                                             @else src="{{ URL::asset('images/uploads/avatars/image.png') }}" @endif>
                                        <div>
                                            <label><input style="margin-right: 10px;" type="radio" value="image1"
                                                          name="cover"
                                                          @if ($deal->cover_image1 == 1) checked="checked" @endif>Cover
                                                Image</label>
                                        </div>
                                    </div>
                                    <div style="float: left;">
                                        <img style="width:200px;height:200px;" id="img_image2"
                                             @if ($deal->image2) src="{{ $deal->image2 }}"
                                             @else src="{{ URL::asset('images/uploads/avatars/image.png') }}" @endif>
                                        <div>
                                            <label><input style="margin-right: 10px;" type="radio" value="image2"
                                                          name="cover"
                                                          @if ($deal->cover_image2 == 1) checked="checked" @endif>Cove
                                                Image</label>
                                        </div>
                                    </div>
                                    <div style="float: left;">
                                        <img style="width:200px;height:200px;" id="img_image3"
                                             @if ($deal->image3) src="{{ $deal->image3 }}"
                                             @else src="{{ URL::asset('images/uploads/avatars/image.png') }}" @endif>
                                        <div>
                                            <label><input style="margin-right: 10px;" type="radio" value="image3"
                                                          name="cover"
                                                          @if ($deal->cover_image3 == 1) checked="checked" @endif>Cover
                                                Image</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                {{ Form::label('note', 'Note:', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-10">
                                    {{ Form::textarea('note', $deal->note, ['class' => 'form-control', 'readonly']) }}
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                {{ Form::label('created_at', 'Created At:', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-10">
                                    {{ Form::label('created_at', $deal->created_at, ['class' => 'control-label']) }}
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                {{ Form::label('updated_at', 'Updated At:', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-10">
                                    {{ Form::label('updated_at', $deal->updated_at, ['class' => 'control-label']) }}
                                </div>
                            </div>
                            @if (!empty($deal->deleted_at))
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    {{ Form::label('deleted_at', 'Deleted At:', ['class' => 'col-sm-2 control-label']) }}
                                    <div style="text-align:left" class="col-sm-10 control-label">
                                        <span class="label label-danger">{{ $deal->deleted_at }}</span>
                                    </div>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.modals.delete')

@endsection