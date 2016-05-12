@extends('layouts.app')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>{{ $store->name }}</h2>
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
                <li class="active">
                    <strong>{{ $store->name }}</strong>
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
                               class="btn btn-info"> Deals </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div style="min-height:65px;" class="ibox-title">
                        <h5>{{ $store->name }}</h5>
                        <div style="display:inline-block;float: right">
                            <a href="{{ route('businesses.stores.edit', [$business->id, $store->id]) }}"
                               class="btn btn-success btn-sm"><i class="fa fa-pencil"></i>
                                Edit </a>
                            {!! Form::open(array('method' => 'DELETE', 'style' => 'display: inline-block','route' => ['businesses.stores.destroy', $business->id, $store->id])) !!}
                            <button class="btn btn-sm btn-danger" type="button"
                                    data-toggle="modal"
                                    data-target="#confirmDelete"
                                    data-title="Confirm Delete Store"
                                    data-message="Are you sure you want to delete this store?">
                                <i class="fa fa-trash"></i> Delete
                            </button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <div class="ibox-content">
                        <form class="form-horizontal">
                            <div class="form-group">
                                {{ Form::label('name', 'Name:', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-10">
                                    {{ Form::label('name', $store->name, ['class' => 'control-label']) }}
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                {{ Form::label('overview', 'Overview:', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-10">
                                    {{ Form::textarea('overview', $store->overview, ['class' => 'form-control', 'readonly']) }}
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                {{ Form::label('address', 'Address:', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-10">
                                    {{ Form::label('address', $store->address, ['class' => 'control-label']) }}
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                {{ Form::label('city', 'City:', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-10">
                                    {{ Form::label('city', $store->city, ['class' => 'control-label']) }}
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                {{ Form::label('state', 'State:', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-10">
                                    {{ Form::label('state', $store->state, ['class' => 'control-label']) }}
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                {{ Form::label('zip_code', 'Zip Code:', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-10">
                                    {{ Form::label('zip_code', $store->zip_code, ['class' => 'control-label']) }}
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                {{ Form::label('latitude', 'Latitude:', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-10">
                                    {{ Form::label('latitude', $store->latitude, ['class' => 'control-label']) }}
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                {{ Form::label('longitude', 'Longitude:', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-10">
                                    {{ Form::label('longitude', $store->longitude, ['class' => 'control-label']) }}
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                {{ Form::label('email', 'Email:', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-10">
                                    {{ Form::label('email', $store->email, ['class' => 'control-label']) }}
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                {{ Form::label('mobile_number', 'Mobile Number:', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-10">
                                    {{ Form::label('mobile_number', $store->mobile_number, ['class' => 'control-label']) }}
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                {{ Form::label('phone_number', 'Phone Number:', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-10">
                                    {{ Form::label('phone_number', $store->phone_number, ['class' => 'control-label']) }}
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                {{ Form::label('league', 'League:', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-10">
                                    {{ Form::label('league', $store->league, ['class' => 'control-label']) }}
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                {{ Form::label('working_hours', 'Working Hours:', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-10">
                                    <div class="input-group m-b"><span style="width: 100px;background-color: #e5e6e7" class="input-group-addon">Mon Open</span><span class="form-control">{{ $store->mon_open }}</span><span class="input-group-addon">AM</span><span style="width: 100px;background-color: #e5e6e7" class="input-group-addon">Mon Close</span><span class="form-control">{{ $store->mon_close }}</span><span class="input-group-addon">PM</span></div>
                                    <div class="input-group m-b"><span style="width: 100px;background-color: #e5e6e7" class="input-group-addon">Tue Open</span><span class="form-control">{{ $store->tue_open }}</span><span class="input-group-addon">AM</span><span style="width: 100px;background-color: #e5e6e7" class="input-group-addon">Tue Close</span><span class="form-control">{{ $store->tue_close }}</span><span class="input-group-addon">PM</span></div>
                                    <div class="input-group m-b"><span style="width: 100px;background-color: #e5e6e7" class="input-group-addon">Wed Open</span><span class="form-control">{{ $store->wed_open }}</span><span class="input-group-addon">AM</span><span style="width: 100px;background-color: #e5e6e7" class="input-group-addon">Wed Close</span><span class="form-control">{{ $store->wed_close }}</span><span class="input-group-addon">PM</span></div>
                                    <div class="input-group m-b"><span style="width: 100px;background-color: #e5e6e7" class="input-group-addon">Thu Open</span><span class="form-control">{{ $store->thu_open }}</span><span class="input-group-addon">AM</span><span style="width: 100px;background-color: #e5e6e7" class="input-group-addon">Thu Close</span><span class="form-control">{{ $store->thu_close }}</span><span class="input-group-addon">PM</span></div>
                                    <div class="input-group m-b"><span style="width: 100px;background-color: #e5e6e7" class="input-group-addon">Fri Open</span><span class="form-control">{{ $store->fri_open }}</span><span class="input-group-addon">AM</span><span style="width: 100px;background-color: #e5e6e7" class="input-group-addon">Fri Close</span><span class="form-control">{{ $store->fri_close }}</span><span class="input-group-addon">PM</span></div>
                                    <div class="input-group m-b"><span style="width: 100px;background-color: #e5e6e7" class="input-group-addon">Sat Open</span><span class="form-control">{{ $store->sat_open }}</span><span class="input-group-addon">AM</span><span style="width: 100px;background-color: #e5e6e7" class="input-group-addon">Sat Close</span><span class="form-control">{{ $store->sat_close }}</span><span class="input-group-addon">PM</span></div>
                                    <div class="input-group m-b"><span style="width: 100px;background-color: #e5e6e7" class="input-group-addon">Sun Open</span><span class="form-control">{{ $store->sun_open }}</span><span class="input-group-addon">AM</span><span style="width: 100px;background-color: #e5e6e7" class="input-group-addon">Sun Close</span><span class="form-control">{{ $store->sun_close }}</span><span class="input-group-addon">PM</span></div>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                {{ Form::label('status', 'Status:', ['class' => 'col-sm-2 control-label']) }}
                                <div style="text-align:left" class="col-sm-10 control-label">
                                    @if ($store->active == 1)
                                        <span class="label label-primary">Active</span>
                                    @else
                                        <span class="label label-danger">Inactive</span>
                                    @endif
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                {{ Form::label('created_at', 'Created At:', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-10">
                                    {{ Form::label('created_at', $store->created_at, ['class' => 'control-label']) }}
                                </div>
                            </div>
                            @if (!empty($store->deleted_at))
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    {{ Form::label('deleted_at', 'Deleted At:', ['class' => 'col-sm-2 control-label']) }}
                                    <div style="text-align:left" class="col-sm-10 control-label">
                                        <span class="label label-danger">{{ $store->deleted_at }}</span>
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