@extends('layouts.app')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Edit {{ $state->name }}</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li>
                    <a>Locations</a>
                </li>
                <li>
                    <a>States</a>
                </li>
                <li>
                    <a href="{{ route('locations.states.all') }}">All</a>
                </li>
                <li class="active">
                    <a href="{{ route('locations.states.show', $state->id) }}">{{ $state->name }}</a>
                </li>
                <li class="active">
                    <strong>Edit</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Edit {{ $state->name }}</h5>
                    </div>
                    <div class="ibox-content">

                        @include('errors.list')

                        {!! Form::model($state, array('method' => 'PATCH', 'class' => 'form-horizontal', 'route' => ['locations.states.update',$state->id])) !!}

                        @include('partials.forms.state-form', ['showStatusSection' => 'Yes' , 'submitButtonText' => 'Update State'])

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection