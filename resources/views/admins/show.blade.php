@extends('layouts.app')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>{{ $admin->name }}</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li>
                    <a>Admins</a>
                </li>
                <li>
                    <a href="{{ route('admins.all') }}">All</a>
                </li>
                <li class="active">
                    <strong>{{ $admin->name }}</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div style="min-height:65px;" class="ibox-title">
                        <h5>{{ $admin->name }}</h5>
                        <div style="display:inline-block;float: right">
                            <a href="{{ route('admins.edit', $admin->id) }}"
                               class="btn btn-success btn-sm"><i class="fa fa-pencil"></i>
                                Edit </a>
                            {!! Form::open(array('method' => 'DELETE', 'style' => 'display: inline-block','route' => ['admins.destroy',$admin->id])) !!}
                            <button class="btn btn-sm btn-danger" type="button"
                                    data-toggle="modal"
                                    data-target="#confirmDelete"
                                    data-title="Confirm Delete User"
                                    data-message="Are you sure you want to delete this user?">
                                <i class="fa fa-trash"></i> Delete
                            </button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <div class="ibox-content">
                        <form class="form-horizontal">
                            <div class="form-group">
                                {{ Form::label('profile_picture', 'Profile Picture:', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-10">
                                    <img style="width:150px;height:150px;float:left;" id="img_profile_picture"
                                         @if ($admin->profile_picture) src="{{ $admin->profile_picture }}"
                                         @else src="{{ URL::asset('images/uploads/avatars/default.png') }}" @endif>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                {{ Form::label('name', 'Name:', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-10">
                                    {{ Form::label('name', $admin->name, ['class' => 'control-label']) }}
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                {{ Form::label('email', 'Email:', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-10">
                                    {{ Form::label('email', $admin->email, ['class' => 'control-label']) }}
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                {{ Form::label('mobile_number', 'Mobile Number:', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-10">
                                    {{ Form::label('mobile_number', '+91'.$admin->mobile_number, ['class' => 'control-label']) }}
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                {{ Form::label('role', 'Role:', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-10">
                                    {{ Form::label('role', $admin->role, ['class' => 'control-label']) }}
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                {{ Form::label('portal_active', 'Portal Active:', ['class' => 'col-sm-2 control-label']) }}
                                <div style="text-align:left" class="col-sm-10 control-label">
                                    @if ($admin->portal_active == 1)
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
                                    {{ Form::label('created_at', $admin->created_at, ['class' => 'control-label']) }}
                                </div>
                            </div>
                            @if (!empty($admin->deleted_at))
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    {{ Form::label('deleted_at', 'Deleted At:', ['class' => 'col-sm-2 control-label']) }}
                                    <div style="text-align:left" class="col-sm-10 control-label">
                                        <span class="label label-danger">{{ $admin->deleted_at }}</span>
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