@extends('layouts.app')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Create</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li>
                    <a>Businesses</a>
                </li>
                <li class="active">
                    <strong>Create</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Create Business</h5>
                    </div>
                    <div class="ibox-content">

                        @include('errors.list')

                        {!! Form::open(array('class' => 'form-horizontal', 'route' => 'businesses.store')) !!}

                        @include('partials.forms.business-form',  ['showOwnerSection' => 'Yes', 'showStatusSection' => 'No', 'submitButtonText' => 'Create Business'])

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection