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
                    <div class="ibox-title">
                        <h5>Edit {{ $admin->name }}</h5>
                    </div>
                    <div class="ibox-content">

                        @include('errors.list')

                        {!! Form::model($admin, array('method' => 'PATCH', 'class' => 'form-horizontal', 'route' => ['admins.update',$admin->id])) !!}

                        @include('partials.forms.admin-form', ['showStatusSection' => 'Yes' , 'submitButtonText' => 'Update Admin'])

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection