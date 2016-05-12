@extends('layouts.app')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>{{ $category->name }}</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li>
                    <a>Categories</a>
                </li>
                <li>
                    <a href="{{ route('categories.all') }}">All</a>
                </li>
                <li class="active">
                    <strong>{{ $category->name }}</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div style="min-height:60px;" class="ibox-title">
                        <h5>{{ $category->name }}</h5>
                        <a href="{{ route('categories.edit', $category->id) }}"
                           class="btn btn-success btn-sm" style="float: right"><i class="fa fa-pencil"></i>
                            Edit </a>
                    </div>
                    <div class="ibox-content">
                        <form class="form-horizontal">
                            <div class="form-group">
                                {{ Form::label('name', 'Name:', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-10">
                                    {{ Form::label('name', $category->name, ['class' => 'control-label']) }}
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                {{ Form::label('commission', 'Commission (%):', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-10">
                                    {{ Form::label('name', $category->commission, ['class' => 'control-label']) }}
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                {{ Form::label('order', 'Order:', ['class' => 'col-sm-2 control-label']) }}
                                <div class="col-sm-10">
                                    {{ Form::label('name', $category->order, ['class' => 'control-label']) }}
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                {{ Form::label('status', 'Status:', ['class' => 'col-sm-2 control-label']) }}
                                <div style="text-align:left" class="col-sm-10 control-label">
                                    @if ($category->active == 1)
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
                                    {{ Form::label('created_at', $category->created_at, ['class' => 'control-label']) }}
                                </div>
                            </div>
                            @if (!empty($category->deleted_at))
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    {{ Form::label('deleted_at', 'Deleted At:', ['class' => 'col-sm-2 control-label']) }}
                                    <div style="text-align:left" class="col-sm-10 control-label">
                                        <span class="label label-danger">{{ $category->deleted_at }}</span>
                                    </div>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection