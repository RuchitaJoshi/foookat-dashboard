@extends('layouts.app')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>{{ $user->name }}</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li>
                    <a>Users</a>
                </li>
                <li>
                    <a href="{{ route('users.all') }}">All</a>
                </li>
                <li class="active">
                    <strong>{{ $user->name }}</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Edit {{ $user->name }}</h5>
                    </div>
                    <div class="ibox-content">

                        @include('errors.list')

                        {!! Form::model($user, array('method' => 'PATCH', 'class' => 'form-horizontal', 'route' => ['users.update',$user->id])) !!}

                        @include('partials.forms.user-form', ['showStatusSection' => 'Yes', 'submitButtonText' => 'Update User'])

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection