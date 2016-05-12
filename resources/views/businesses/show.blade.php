@extends('layouts.app')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>{{ $business->name }}</h2>
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
                <li class="active">
                    <strong>{{ $business->name }}</strong>
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
                            <a href="{{ route('businesses.stores', $business->id) }}"
                               class="btn btn-info"> Stores </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="ibox float-e-margins">
                    <div style="min-height:65px;" class="ibox-title">
                        <h5>{{ $business->name }}</h5>
                        <div style="display:inline-block;float: right">
                            <a href="{{ route('businesses.edit', $business->id) }}"
                               class="btn btn-success btn-sm"><i class="fa fa-pencil"></i>
                                Edit </a>
                            {!! Form::open(array('method' => 'DELETE', 'style' => 'display: inline-block','route' => ['businesses.destroy',$business->id])) !!}
                            <button class="btn btn-sm btn-danger" type="button"
                                    data-toggle="modal"
                                    data-target="#confirmDelete"
                                    data-title="Confirm Delete Business"
                                    data-message="Are you sure you want to delete this business?">
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
                                    {{ Form::label('name', $business->name, ['class' => 'control-label']) }}
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                {{ Form::label('address', 'Address:', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-10">
                                    {{ Form::label('address', $business->address, ['class' => 'control-label']) }}
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                {{ Form::label('city', 'City:', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-10">
                                    {{ Form::label('city', $business->city, ['class' => 'control-label']) }}
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                {{ Form::label('state', 'State:', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-10">
                                    {{ Form::label('state', $business->state, ['class' => 'control-label']) }}
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                {{ Form::label('zip_code', 'Zip Code:', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-10">
                                    {{ Form::label('zip_code', $business->zip_code, ['class' => 'control-label']) }}
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                {{ Form::label('type', 'Type:', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-10">
                                    {{ Form::label('type', $business->type, ['class' => 'control-label']) }}
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                {{ Form::label('status', 'Status:', ['class' => 'col-sm-2 control-label']) }}
                                <div style="text-align:left" class="col-sm-10 control-label">
                                    @if ($business->active == 1)
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
                                    {{ Form::label('created_at', $business->created_at, ['class' => 'control-label']) }}
                                </div>
                            </div>
                            @if (!empty($business->deleted_at))
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    {{ Form::label('deleted_at', 'Deleted At:', ['class' => 'col-sm-2 control-label']) }}
                                    <div style="text-align:left" class="col-sm-10 control-label">
                                        <span class="label label-danger">{{ $business->deleted_at }}</span>
                                    </div>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="ibox float-e-margins">
                    <div style="min-height:65px;" class="ibox-title">
                        <h5>Owner: {{ $business->owner_name }}</h5>
                    </div>
                    <div class="ibox-content">
                        <form class="form-horizontal">
                            <div class="form-group">
                                {{ Form::label('name', 'Name:', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-10">
                                    {{ Form::label('name', $business->owner_name, ['class' => 'control-label']) }}
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                {{ Form::label('email', 'Email:', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-10">
                                    {{ Form::label('email', $business->owner_email, ['class' => 'control-label']) }}
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                {{ Form::label('mobile_number', 'Mobile Number:', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-10">
                                    {{ Form::label('mobile_number', $business->owner_mobile_number, ['class' => 'control-label']) }}
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                {{ Form::label('status', 'Status:', ['class' => 'col-sm-2 control-label']) }}
                                <div style="text-align:left" class="col-sm-10 control-label">
                                    @if ($business->owner_active == 1)
                                        <span class="label label-primary">Active</span>
                                    @else
                                        <span class="label label-danger">Inactive</span>
                                    @endif
                                </div>
                            </div>
                            @if (!empty($business->owner_deleted_at))
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    {{ Form::label('deleted_at', 'Deleted At:', ['class' => 'col-sm-2 control-label']) }}
                                    <div style="text-align:left" class="col-sm-10 control-label">
                                        <span class="label label-danger">{{ $business->owner_deleted_at }}</span>
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